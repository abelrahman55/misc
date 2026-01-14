<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingNursingProvider;
use App\Models\NursingMakeOffer;
use App\Models\NursingPackageMessage;
use App\Models\PackageNursing;
use App\Models\PackageNursingOption;
use App\Models\RelatedPackageNursingOption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageNursingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
         public function my_nursing_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = NursingPackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc') // أحدث الرسائل أول
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages_nursing.my_nursing_messages', compact('messages', 'id'));
    }
    public function index()
    {
        $packages = PackageNursing::with('optionsNursing')->latest()->paginate(10);
        return view('packages_nursing.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageNursingOption::all();
        return view('packages_nursing.create', compact('package_options'));
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
            'price'    => 'nullable|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package = PackageNursing::create([
            'title' => $data['title'],
            // 'price' => $data['price'],
        ]);

        if (! empty($data['options'])) {
            $package->optionsNursing()->sync($data['options']);
        }

        return redirect()->route('packages_nursing.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = PackageNursing::with('optionsNursing')->findOrFail($id);
        return view('packages_nursing.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package          = PackageNursing::with('optionsNursing')->findOrFail($id);
        $package_options  = PackageNursingOption::all();
        $selected_options = RelatedPackageNursingOption::where('package_nursing_id', $id)->pluck('package_nursing_option_id')->toArray();
        // return $package;
        return view('packages_nursing.edit', compact('package', 'package_options', 'selected_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $package = PackageNursing::findOrFail($id);

        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            'price'    => 'nullable|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package->update([
            'title' => $data['title'],
            // 'price' => $data['price'],
        ]);

        $package->optionsNursing()->sync($data['options'] ?? []);

        return redirect()->route('packages_nursing.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = PackageNursing::findOrFail($id);
        $package->optionsNursing()->detach();
        $package->delete();

        return redirect()->route('packages_nursing.index')->with('success', 'Package deleted successfully.');
    }
    public function packages_nursing_reservations()
    {
        $id            = request('id');
        $conversations = BookingNursingProvider::with('user', 'messages')->where('package_id', $id)->paginate(10);
        // return $conversations;
        return view('packages_nursing.reservations', compact('conversations', 'id'));
    }

    public function nursing_make_provider_price()
    {
        $id = request('id');

        $conversations = BookingNursingProvider::with('provider', 'package', 'options', 'user')
            ->where('id', $id)
            ->paginate(10);
        // return $conversations;
        $providers = User::whereIn('type', ['hospital', 'hotel'])
            ->get(['id', 'f_name', 'l_name', 'm_name']);

        // ✅ نجيب العرض القديم لو موجود
        $offer = NursingMakeOffer::where('booking_id', $id)->first();

        return view('packages_nursing.make_nursing_price', compact('conversations', 'id', 'providers', 'offer'));
    }
    public function nursing_make_offer(Request $request)
    {
        $book = BookingNursingProvider::where('id', $request->booking_id)->first();

        // هل فيه عرض معمول قبل كده؟
        $offer = NursingMakeOffer::where('booking_id', $book->id)->first();

        if ($offer) {
            // تعديل العرض القديم
            $offer->update([
                // 'provider_id'    => $request->provider_id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم تعديل العرض بنجاح');
        } else {
            // إنشاء عرض جديد
            NursingMakeOffer::create([
                'user_id'        => $book->user_id,
                // 'provider_id'    => $request->provider_id,
                'booking_id'     => $book->id,
                'provider_price' => $request->provider_price,
            ]);
            return back()->with('success', 'تم إنشاء العرض بنجاح');
        }
    }
    // public function nursing_conv_messages(Request $request)
    // {
    //     $id = $request->id;

    //     // number of messages per page
    //     $perPage = 20;

    //     $messages = NursingPackageMessage::with('user')
    //         ->where('book_package_id', $id)
    //         ->orderBy('id', 'desc') // أحدث الأول
    //         ->paginate($perPage);

    //     return view('packages_nursing.messages', compact('messages', 'id'));
    // }

    public function nursing_conv_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = NursingPackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc') // أحدث الرسائل أول
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages_nursing.messages', compact('messages', 'id'));
    }

    public function load_more_nursing_messages(Request $request)
    {
        $id      = $request->id;
        $perPage = 20;

        $messages = NursingPackageMessage::with('user')
            ->where('book_package_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // عكس ترتيب الرسائل
        $messages->setCollection($messages->getCollection()->reverse());

        return view('packages_nursing._message_items', compact('messages'))->render();
    }

    public function nursin_send_message(Request $request, $id)
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
        NursingPackageMessage::create([
            'message'         => $request->message,
            'book_package_id' => $id,
            'user_id'         => $user->id,
            'user_type'       => 'user',
            'file'            => $path,
        ]);
        return back();
    }

}
