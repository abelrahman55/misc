<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingProvider;
use App\Models\Package;
use App\Models\PackageMakeOffer;
use App\Models\PackageMessage;
use App\Models\PackageOption;
use App\Models\RelatedPackageOption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        public function my_seekin_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;
        // $user=Auth::guard('web')->user();

        $messages = PackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc') // أحدث الرسائل أول
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages.messages', compact('messages', 'id'));
    }
    
    public function index()
    {
        $packages = Package::with('options')->latest()->paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function packages_reservations()
    {
        $id            = request('id');
        $conversations = BookingProvider::with('user', 'messages')->where('package_id', $id)->paginate(10);
        // return $conversations;
        return view('packages.reservations', compact('conversations', 'id'));
    }

    public function package_conv_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = PackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc') // أحدث الرسائل أول
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages.messages', compact('messages', 'id'));
    }

    public function load_more_nursing_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = PackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages._message_items', compact('messages'))->render();
    }

    public function package_send_message(Request $request, $id)
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
        PackageMessage::create([
            'message'         => $request->message,
            'book_package_id' => $id,
            'user_id'         => $user->id,
            'user_type'       => 'user',
            'file'            => $path,
        ]);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageOption::all();
        return view('packages.create', compact('package_options'));
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
            'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package = Package::create([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        if (! empty($data['options'])) {
            $package->options()->sync($data['options']);
        }

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = Package::with('options')->findOrFail($id);
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package          = Package::with('options')->findOrFail($id);
        $package_options  = PackageOption::all();
        $selected_options = RelatedPackageOption::where('package_id', $id)->pluck('package_option_id')->toArray();
        // return $package;
        return view('packages.edit', compact('package', 'package_options', 'selected_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $package = Package::findOrFail($id);

        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package->update([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        $package->options()->sync($data['options'] ?? []);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->options()->detach();
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }

    public function packag_make_price()
    {
        $id = request('id');

        $conversations = BookingProvider::with('provider', 'package', 'options')
            ->where('id', $id)
            ->paginate(10);

        $providers = User::whereIn('type', ['hospital', 'hotel'])
            ->get(['id', 'f_name', 'l_name', 'm_name']);

        // ✅ نجيب العرض القديم لو موجود
        $offer = PackageMakeOffer::where('booking_id', $id)->first();

        return view('packages.make_package_price', compact('conversations', 'id', 'providers', 'offer'));
    }

    public function package_make_offer(Request $request)
    {
        $book = BookingProvider::where('id', $request->booking_id)->first();

        // هل فيه عرض معمول قبل كده؟
        $offer = PackageMakeOffer::where('booking_id', $book->id)->first();

        if ($offer) {
            // تعديل العرض القديم
            $offer->update([
                'provider_id'    => $request->provider_id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم تعديل العرض بنجاح');
        } else {
            // إنشاء عرض جديد
            PackageMakeOffer::create([
                'user_id'        => $book->user_id,
                'provider_id'    => $request->provider_id,
                'booking_id'     => $book->id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم إنشاء العرض بنجاح');
        }
    }
}
