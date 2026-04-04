<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\AppointmentPackage;
use App\Models\AppointmentConversation;
use App\Models\PackageOption;
use App\Models\User;
use App\Models\AppointmentPackageManualItem;
use App\Models\Coupon;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentPackageController extends Controller
{
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }
    public function startChat(Request $request, $appointment_id)
    {
        $appointment = Appointment::findOrFail($appointment_id);
        $package = AppointmentPackage::where('appointment_id', $appointment_id)->first();
        $type = $request->query('type');

        $currentUserId = Auth::guard('web')->id();
        $targetUserId = null;

        if ($appointment->client_id == $currentUserId) {
            // Patient is clicking.
            if ($type == 'doctor') {
                $targetUserId = $appointment->doctor_id;
                if (!$targetUserId || !User::where('id', $targetUserId)->exists()) {
                    return redirect()->back()->with('error', 'No doctor is currently assigned to this appointment.');
                }
            } elseif ($type == 'admin') {
                $targetUserId = $package ? $package->admin_id : null;
                if (!$targetUserId || !User::where('id', $targetUserId)->exists()) {
                    // Find any admin if specific one not found
                    $targetUserId = User::where('role', 'admin')->first()?->id;
                }
            } else {
                // Default fallback logic (no type specified)
                $targetUserId = $package ? $package->admin_id : $appointment->doctor_id;

                // Final validation with fallback to any admin
                if (!$targetUserId || !User::where('id', $targetUserId)->exists()) {
                    $targetUserId = User::where('role', 'admin')->first()?->id;
                }
            }
        } else {
            // Admin or Provider is clicking. Target is the Client.
            $targetUserId = $appointment->client_id;
        }

        if (!$targetUserId) {
            return redirect()->back()->with('error', 'Could not find a valid user to start chat with.');
        }

        // Find or create conversation in the NEW table for this SPECIFIC appointment
        $conversation = AppointmentConversation::where('appointment_id', $appointment_id)
            ->where(function ($q) use ($currentUserId, $targetUserId) {
                $q->where(function ($sub) use ($currentUserId, $targetUserId) {
                    $sub->where('user_id', $currentUserId)->where('receiver_id', $targetUserId);
                })->orWhere(function ($sub) use ($currentUserId, $targetUserId) {
                    $sub->where('user_id', $targetUserId)->where('receiver_id', $currentUserId);
                });
            })->first();

        if (!$conversation) {
            $conversation = AppointmentConversation::create([
                'user_id' => $currentUserId,
                'receiver_id' => $targetUserId,
                'appointment_id' => $appointment_id,
            ]);
        }
        return redirect()->route('appointment_chat.show', $conversation->id);
    }

    public function create($appointment_id)
    {
        $appointment = Appointment::with('client')->findOrFail($appointment_id);
        $options = PackageOption::all();
        $providers = User::whereIn('role', ['doctor', 'provider', 'hospital'])->get(); // Unified check for providers

        return view('dashboard.appointment_packages.create', compact('appointment', 'options', 'providers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'client_id' => 'required|exists:users,id',
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'price' => 'required|numeric',
            'provider_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $package = AppointmentPackage::create([
                'appointment_id' => $request->appointment_id,
                'client_id' => $request->client_id,
                'admin_id' => Auth::guard('web')->id(),
                'provider_id' => $request->provider_id,
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en,
                ],
                'price' => $request->price,
                'status' => 'pending',
            ]);

            foreach ($request->items as $itemTitle) {
                \App\Models\AppointmentPackageManualItem::create([
                    'appointment_package_id' => $package->id,
                    'title' => $itemTitle,
                ]);
            }

            DB::commit();
            return redirect()->route('appointments.index')->with('success', 'Special package created and sent to client.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error creating package: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $package = AppointmentPackage::with(['appointment', 'client', 'provider', 'manualItems'])->findOrFail($id);
        return view('dashboard.appointment_packages.show', compact('package'));
    }

    public function patientIndex()
    {
        $packages = AppointmentPackage::where('client_id', Auth::guard('web')->id())
            ->with(['appointment', 'provider', 'manualItems'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboard.patient.appointment_packages.index', compact('packages'));
    }

    public function pay(Request $request)
    {
        $user = Auth::guard('web')->user();

        $request->validate([
            'package_id' => 'required|exists:appointment_packages,id',
            'coupon_code' => 'nullable|string',
            'use_points' => 'nullable|boolean',
        ]);

        $package = AppointmentPackage::findOrFail($request->package_id);

        if ($package->status == 'paid') {
            return back()->with('error', 'Package is already paid.');
        }

        $amount = $package->price;
        $coupon = null;

        // 1. Coupon Logic
        if (!empty($request->coupon_code)) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if (!$coupon || $coupon->status != 1) { // Add more rigorous checks as in MyBookingsController
                return back()->with('error', 'Invalid or inactive coupon.');
            }
            // ... (Add date/usage checks)

            $discount = $amount * ($coupon->discount_percent / 100);
            $amount -= $discount;
        }

        // 2. Points Logic
        if ($request->boolean('use_points') && $user->points > 0) {
            $deduct = min($user->points, $amount);
            $amount -= $deduct;
            $user->points -= $deduct; // Deduct immediately or hold? For now, we deduct here.
            $user->save();
        }

        // 3. Initiate Payment
        if ($amount <= 0) {
            // Fully paid by points/coupon
            $package->update(['status' => 'paid']);
            $package->appointment->update(['paid' => true]);
            if ($coupon) $coupon->increment('used_count');
            return redirect()->back()->with('success', 'Package paid successfully.');
        }

        // Paymob Flow
        try {
            $token = $this->paymobService->getAuthenticationToken();
            $orderId = $this->paymobService->registerOrder($token, $amount * 100, "PKG-{$package->id}-" . time());
            $paymentKey = $this->paymobService->getPaymentKey($token, $orderId, $amount * 100, $this->paymobService->formatBillingData($user));

            if ($coupon) $coupon->increment('used_count'); // Increment usage if proceed to payment

            return redirect("https://accept.paymob.com/api/acceptance/iframes/" . config('services.paymob.iframe_id') . "?payment_token={$paymentKey}");
        } catch (\Exception $e) {
            return back()->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    public function callback(Request $request)
    {
        // 1. Verify HMAC
        if (!$this->paymobService->verifyHmac($request->all())) {
            Log::warning('Paymob HMAC verification failed.', ['data' => $request->all()]);
            return abort(403);
        }

        // 2. Check Success Status
        $success = filter_var($request->success, FILTER_VALIDATE_BOOLEAN);

        if ($success) {
            $orderId = $request->input('order'); // Paymob Order ID
            // Ideally we need to store Paymob Order ID in our DB to match it.
            // But if we used merchant_order_id as "PKG-{id}-{timestamp}", we can parse it from 'merchant_order_id' if returned.
            // Paymob callback contains 'merchant_order_id'.

            $merchantOrderId = $request->input('merchant_order_id');
            if ($merchantOrderId && preg_match('/PKG-(\d+)-/', $merchantOrderId, $matches)) {
                $packageId = $matches[1];
                $package = AppointmentPackage::find($packageId);

                if ($package && $package->status != 'paid') {
                    $package->update([
                        'status' => 'paid',
                        // Store transaction ID if needed
                    ]);
                    $package->appointment->update(['paid' => true]);

                    // Increment coupon usage if not already done?
                    // We did it at payment initialization, but if payment fails, we might want to decrement.
                    // For simplicity, we assume initialization is intent.

                    Log::info("Package #{$packageId} marked as paid update via Paymob callback.");
                }
            }
        } else {
            Log::info('Paymob payment failed or pending.', ['data' => $request->all()]);
        }

        return response()->json(['success' => true]);
    }

    public function respond(Request $request, $id)
    {
        $package = AppointmentPackage::where('client_id', Auth::guard('web')->id())->findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|string|nullable',
        ]);

        $package->update([
            'status' => $request->status,
            'rejection_reason' => $request->status == 'rejected' ? $request->rejection_reason : null,
        ]);

        return redirect()->back()->with('success', 'Response recorded successfully.');
    }


    public function edit($id)
    {
        $package = AppointmentPackage::with(['client', 'provider', 'manualItems'])->findOrFail($id);
        $providers = User::whereIn('role', ['doctor', 'provider', 'hospital'])->get();

        return view('dashboard.appointment_packages.edit', compact('package', 'providers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_ar' => 'required|string',
            'title_en' => 'required|string',
            'price' => 'required|numeric',
            'provider_id' => 'required|exists:users,id',
            'items' => 'required|array|min:1',
            'items.*' => 'required|string',
        ]);

        $package = AppointmentPackage::findOrFail($id);

        DB::beginTransaction();
        try {
            $package->update([
                'provider_id' => $request->provider_id,
                'title' => [
                    'ar' => $request->title_ar,
                    'en' => $request->title_en,
                ],
                'price' => $request->price,
                'status' => 'pending', // Reset status to pending for renewal
                'rejection_reason' => null, // Clear rejection reason
            ]);

            // Sync items (delete old, create new)
            $package->manualItems()->delete();
            foreach ($request->items as $itemTitle) {
                \App\Models\AppointmentPackageManualItem::create([
                    'appointment_package_id' => $package->id,
                    'title' => $itemTitle,
                ]);
            }

            DB::commit();
            return redirect()->route('appointments.index')->with('success', 'Package updated and resent to client.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating package: ' . $e->getMessage());
        }
    }
}
