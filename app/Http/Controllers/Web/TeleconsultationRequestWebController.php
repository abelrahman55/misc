<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TeleconsultationRequest;
use App\Models\TeleconsultationMessage;
use App\Models\User;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeleconsultationRequestWebController extends Controller
{
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    public function index()
    {
        $requests = TeleconsultationRequest::with(['client', 'specialty', 'doctor'])->orderBy('created_at', 'desc')->paginate(15);
        $doctors = User::where('type', 'doctor')->get();
        return view('dashboard.teleconsultation_requests.index', compact('requests', 'doctors'));
    }

    public function makeOffer(Request $request, $id)
    {
        $req = TeleconsultationRequest::findOrFail($id);
        $request->validate([
            'price' => 'required|numeric',
            'doctor_id' => 'required|exists:users,id',
            'offer_details' => 'nullable|string',
        ]);

        $isUpdate = ($req->status == 'offered' || $req->status == 'rejected');

        $req->update([
            'price' => $request->price,
            'doctor_id' => $request->doctor_id,
            'offer_details' => $request->offer_details,
            'admin_id' => Auth::guard('web')->id(),
            'status' => 'offered'
        ]);

        // Auto-post to chat
        $message = $isUpdate ? "Offer Updated: " : "New Offer: ";
        $message .= "Price " . number_format($request->price, 2) . " EGP. Assigned Doctor: " . (User::find($request->doctor_id)->full_name ?? 'Doctor');
        if ($request->offer_details) {
            $message .= ". Details: " . $request->offer_details;
        }

        TeleconsultationMessage::create([
            'teleconsultation_request_id' => $id,
            'user_id' => Auth::guard('web')->id(),
            'user_type' => 'admin',
            'message' => $message,
        ]);

        return back()->with('success', $isUpdate ? 'Offer updated successfully.' : 'Offer created successfully.');
    }

    public function respond(Request $request, $id)
    {
        $user = Auth::guard('web')->user();
        $req = TeleconsultationRequest::where('client_id', $user->id)->findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|string|nullable',
        ]);

        if ($req->status !== 'offered') {
            return back()->with('error', 'You can only respond to a request that is in offered status');
        }

        $req->update([
            'status' => $request->status,
            'rejection_reason' => $request->status == 'rejected' ? $request->rejection_reason : null,
        ]);

        // Auto-post response to chat
        TeleconsultationMessage::create([
            'teleconsultation_request_id' => $id,
            'user_id' => $user->id,
            'user_type' => 'user',
            'message' => $request->status == 'approved' ? "Offer Approved by Patient." : "Offer Rejected. Reason: " . $request->rejection_reason,
        ]);

        if ($request->status == 'approved') {
            return redirect()->route('teleconsultation_requests.patient_index')->with('success', 'Offer approved! You can now proceed to payment.');
        }

        return back()->with('success', 'Response recorded successfully');
    }

    public function patientIndex()
    {
        $requests = TeleconsultationRequest::with(['specialty', 'doctor', 'medicalFiles'])
            ->where('client_id', Auth::guard('web')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboard.patient.teleconsultation_requests.index', compact('requests'));
    }

    public function doctorIndex()
    {
        $requests = TeleconsultationRequest::with(['client', 'specialty', 'medicalFiles'])
            ->where('doctor_id', Auth::guard('web')->id())
            ->whereIn('status', ['paid', 'completed'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboard.doctor.teleconsultation_requests.index', compact('requests'));
    }

    public function pay($id)
    {
        $user = Auth::guard('web')->user();
        $req = TeleconsultationRequest::where('client_id', $user->id)->findOrFail($id);

        if ($req->status !== 'approved') {
            return back()->with('error', 'Request must be approved before payment.');
        }

        $amount = $req->price;

        if ($amount <= 0) {
            $req->update(['status' => 'paid']);
            return redirect()->back()->with('success', 'Teleconsultation paid successfully.');
        }

        try {
            $token = $this->paymobService->getAuthenticationToken();
            $orderId = $this->paymobService->registerOrder($token, $amount * 100, "TC-{$req->id}-" . time());
            $paymentKey = $this->paymobService->getPaymentKey($token, $orderId, $amount * 100, $this->paymobService->formatBillingData($user));

            return redirect("https://accept.paymob.com/api/acceptance/iframes/" . config('services.paymob.iframe_id') . "?payment_token={$paymentKey}");
        } catch (\Exception $e) {
            Log::error('Teleconsultation Paymob Error: ' . $e->getMessage());
            return back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        // 1. Verify HMAC
        if (!$this->paymobService->verifyHmac($request->all())) {
            Log::warning('Teleconsultation Paymob HMAC verification failed.', ['data' => $request->all()]);
            if ($request->isMethod('post')) {
                return response()->json(['error' => 'HMAC verification failed'], 403);
            }
            return abort(403);
        }

        // 2. Check Success Status
        $success = filter_var($request->success, FILTER_VALIDATE_BOOLEAN);

        if ($success) {
            $merchantOrderId = $request->input('merchant_order_id');
            if ($merchantOrderId && preg_match('/TC-(\d+)-/', $merchantOrderId, $matches)) {
                $requestId = $matches[1];
                $req = TeleconsultationRequest::find($requestId);

                if ($req && $req->status != 'paid') {
                    $req->update(['status' => 'paid']);
                    Log::info("Teleconsultation Request #{$requestId} marked as paid via Paymob callback.");

                    // Optional: Auto-post payment confirmation to chat
                    TeleconsultationMessage::create([
                        'teleconsultation_request_id' => $requestId,
                        'user_id' => $req->client_id,
                        'user_type' => 'user',
                        'message' => "Payment completed successfully. Reference: " . ($request->id ?? 'N/A'),
                    ]);
                }
            }
        } else {
            Log::info('Teleconsultation Paymob payment failed or pending.', ['data' => $request->all()]);
        }

        // 3. Response based on request method
        if ($request->isMethod('post')) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('teleconsultation_requests.patient_index')
            ->with($success ? 'success' : 'error', $success ? 'Payment completed successfully!' : 'Payment failed. Please try again.');
    }

    /* --- Chat Methods --- */

    public function messages(Request $request, $id)
    {
        $perPage = 20;
        $req = TeleconsultationRequest::with(['client', 'doctor', 'specialty'])->findOrFail($id);

        $messages = TeleconsultationMessage::with('user')
            ->where('teleconsultation_request_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $messages->setCollection($messages->getCollection()->reverse());

        return view('dashboard.teleconsultation_requests.messages', compact('messages', 'id', 'req'));
    }

    public function loadMoreMessages(Request $request)
    {
        $id = $request->id;
        $perPage = 20;

        $messages = TeleconsultationMessage::with('user')
            ->where('teleconsultation_request_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $messages->setCollection($messages->getCollection()->reverse());

        return view('dashboard.teleconsultation_requests._message_items', compact('messages'))->render();
    }

    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required_without:file',
            'file'    => 'nullable|file|max:10240',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = UploadFile($request->file('file'), 'teleconsultation_messages');
        }

        $user = Auth::guard('web')->user();
        $userType = 'user';

        if (!$user) {
            $user = Auth::guard('web')->user();
            $userType = 'admin';
        }

        if (!$user) {
             return back()->with('error', 'Unauthorized.');
        }

        TeleconsultationMessage::create([
            'teleconsultation_request_id' => $id,
            'user_id' => $user->id,
            'user_type' => $userType,
            'message' => $request->message,
            'file' => $path,
        ]);

        return back()->with('success', 'Message sent.');
    }
    public function joinMeeting($id)
    {
        $req = TeleconsultationRequest::findOrFail($id);
        $user = Auth::guard('web')->user();

        if ($user->id !== $req->doctor_id && $user->id !== $req->client_id && $user->type !== 'admin') {
            return back()->with('error', 'Unauthorized to join this meeting.');
        }

        if (!in_array($req->status, ['paid', 'completed'])) {
            return back()->with('error', 'Meeting requires the request to be paid first.');
        }

        if (!$req->appointment_date) {
            return back()->with('error', 'Appointment date is not set yet.');
        }

        $tz = 'Africa/Cairo';
        $start = \Carbon\Carbon::parse($req->appointment_date, $tz);
        $now = \Carbon\Carbon::now($tz);

        $allowedFrom = $start->copy()->subMinutes(10);
        $allowedTo = $start->copy()->addHours(2);

        if ($now->lt($allowedFrom)) {
            return back()->with('error', 'لا يمكنك الدخول الآن، الدخول يبدأ قبل الميعاد بـ 10 دقائق.');
        }

        if ($now->gt($allowedTo)) {
            return back()->with('error', 'هذا الاجتماع انتهى ولا يمكن الانضمام الآن.');
        }

        $roomName = 'teleconsultation_room_' . $req->id . '_' . md5($req->created_at);
        $meetingUrl = 'https://meet.jit.si/' . $roomName;

        return view('open_meeting', [
            'url' => $meetingUrl,
        ]);
    }
}
