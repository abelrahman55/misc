<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\HospitalPackageMessage;
use App\Models\PackageHospital;
use App\Models\PackageHospitalOption;
use App\Models\ProviderMakeOffer;
use App\Models\RelatedPackageHospitalOption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = PackageHospital::with('optionsHospital')->latest()->paginate(10);
        // return $packages;
        return view('packages_hospital.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageHospitalOption::all();
        return view('packages_hospital.create', compact('package_options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            // 'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package = PackageHospital::create([
            'title' => $data['title'],
            'price' => $data['price'] ?? 0,
        ]);

        if (! empty($data['options'])) {
            $package->optionsHospital()->sync($data['options']);
        }

        return redirect()->route('packages_hospital.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = PackageHospital::with('optionsHospital')->findOrFail($id);
        return view('packages_hospital.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package          = PackageHospital::with('optionsHospital')->findOrFail($id);
        $package_options  = PackageHospitalOption::all();
        $selected_options = RelatedPackageHospitalOption::where('package_hospital_id', $id)->pluck('package_hospital_option_id')->toArray();
        // return $package;
        return view('packages_hospital.edit', compact('package', 'package_options', 'selected_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $package = PackageHospital::findOrFail($id);

        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            // 'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package->update([
            'title' => $data['title'],
            'price' => $data['price'] ?? 0,
        ]);

        $package->optionsHospital()->sync($data['options'] ?? []);

        return redirect()->route('packages_hospital.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = PackageHospital::findOrFail($id);
        $package->optionsHospital()->detach();
        $package->delete();

        return redirect()->route('packages_hospital.index')->with('success', 'Package deleted successfully.');
    }

    public function packages_providers_reservations()
    {
        $id            = request('id');
        $conversations = BookingHospital::with('user', 'messages_by_last')->where('package_id', $id)->paginate(10);
        // return $conversations;
        return view('packages_hospital.reservations', compact('conversations', 'id'));
    }

    public function make_provider_price()
    {
        $id = request('id');

        $conversations = BookingHospital::with('provider', 'package', 'options')
            ->where('id', $id)
            ->paginate(10);

        $providers = User::whereIn('type', ['hospital', 'hotel'])
            ->get(['id', 'f_name', 'l_name', 'm_name']);

        // ✅ نجيب العرض القديم لو موجود
        $offer = ProviderMakeOffer::where('booking_id', $id)->first();

        return view('packages_hospital.make_provider_price', compact('conversations', 'id', 'providers', 'offer'));
    }

    public function provider_conv_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = HospitalPackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc') // أحدث الرسائل أول
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages_hospital.messages', compact('messages', 'id'));
    }

    public function load_more_nursing_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = HospitalPackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages_hospital._message_items', compact('messages'))->render();
    }

    public function provider_send_message(Request $request, $id)
    {
        $request->validate([
            'message' => 'required_without:file',
            'file'    => 'nullable|file',
        ]);

        $path = null;

        if ($request->hasFile('file')) {
            $path = UploadFile($request->file('file'), 'nursing_messages');
            // $path = $request->file('file')->store('nursing_messages', 'public');
        }
        $user = Auth::guard('web')->user();
        HospitalPackageMessage::create([
            'message'         => $request->message,
            'book_package_id' => $id,
            'user_id'         => $user->id,
            'user_type'       => 'user',
            'file'            => $path,
        ]);
        return back();
    }

    public function provider_make_offer(Request $request)
    {
        $book = BookingHospital::where('id', $request->booking_id)->first();

        // هل فيه عرض معمول قبل كده؟
        $offer = ProviderMakeOffer::where('booking_id', $book->id)->first();

        if ($offer) {
            // تعديل العرض القديم
            $offer->update([
                'provider_id'    => $request->provider_id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم تعديل العرض بنجاح');
        } else {
            // إنشاء عرض جديد
            ProviderMakeOffer::create([
                'user_id'        => $book->user_id,
                'provider_id'    => $request->provider_id,
                'booking_id'     => $book->id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم إنشاء العرض بنجاح');
        }
    }

}
