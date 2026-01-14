<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\DoctorFile;
use App\Models\PackageMakeMeeting;
use App\Models\ProviderMakeMeeting;
use App\Models\RateUser;
use App\Models\User;
use App\Models\UserNote;
use App\Services\Api\ProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProvidersController extends Controller
{
    //
    public function best_providers()
    {
        $top = ProviderService::BestProviders();
        return $top;
    }
    public function welcome_provider()
    {
        $user = Auth::guard('web')->user();
        // $tasks        = Appointment::with('client')->where('doctor_id', $user->id)->whereDate('appoint_date', date('Y-m-d'))->paginate(10);
        // $next_patient = Appointment::with('client')->where('doctor_id', $user->id)->whereDate('appoint_date', '>=', date('Y-m-d'))->first();
        $hospitalBookings = BookingHospital::with(['provider', 'package', 'offer'])
            ->where('provider_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'hospital_page');

        $meetings = ProviderMakeMeeting::with(['doctor', 'user'])
            ->where('doctor_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(5, ['*'], 'meetings_page');

        // return $hospitalBookings;
        return view('provider_dash', compact('hospitalBookings', 'meetings'));
    }
    public function provider_profile()
    {
        $user = Auth::guard('web')->user();
        $user = User::with('country', 'usernotes', 'files')->where('id', $user->id)->first();
        // return $user;
        return view('provider.provider_profile', compact('user'));
    }
        public function delete_file(){
        $del=DoctorFile::where('id',request('id'))->delete();
        return redirect()->back()->with('success','تم المسح');
    }
    // public function upload_file(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required',
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     $user            = Auth::guard('web')->user();
    //     $data            = $validator->validated();
    //     $data['user_id'] = $user->id;
    //     if (request()->hasFile('file')) {

    //         // $data['avatar']=request()->file('avatar')->store('users','public');
    //         $destinationPath = public_path('storage/' . 'files');
    //         if (! file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0777, true);
    //         }
    //         $image     = request()->file('file');
    //         $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $image->move($destinationPath, $imageName);

    //         $data['file'] = 'files' . '/' . $imageName;

    //         // return $data['avatar'];
    //     }
    //     // return $data;
    //     $new = DoctorFile::create($data);
    //     return redirect()->back()->with('success', 'تمت الاضافه بنجاح');
    // }

    public function update_profile(Request $request)
    {
        $user = Auth::guard('web')->user();

        $validator = Validator::make($request->all(), [
            'f_name'   => 'nullable|string|max:100',
            'l_name'   => 'nullable|string|max:100',
            'email'    => 'nullable|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string|max:255',
            'dob'      => 'nullable|date',
            'gender'   => 'nullable|string',
            'prof_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('prof_img')) {
            if ($user->prof_img && file_exists(public_path('storage/' . $user->prof_img))) {
                unlink(public_path('storage/' . $user->prof_img));
            }
            $path             = $request->file('prof_img')->store('profile_images', 'public');
            $data['prof_img'] = $path;
        }

        $user->update($data);

        if ($request->hasFile('file')) {
            $file            = $request->file('file');
            $destinationPath = public_path('storage/files');
            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            DoctorFile::create([
                'user_id' => $user->id,
                'file'    => 'files/' . $fileName,
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث البيانات ورفع الملف بنجاح');
    }

    public function add_note(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user            = Auth::guard('web')->user();
        $data            = $validator->validated();
        $data['user_id'] = $user->id;
        $new             = UserNote::create($data);
        return redirect()->back()->with('success', 'تمت الاضافه بنجاح');
        // return $request;
    }
    public function provider_patient(Request $request)
    {
        $user   = Auth::guard('web')->user();
        $search = $request->query('search');

        $patients = PackageMakeMeeting::with('user')
            ->where('doctor_id', $user->id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where(function ($inner) use ($search) {
                        $inner->where('f_name', 'like', "%{$search}%")
                            ->orWhere('l_name', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                });
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('provider.provider_patient', compact('patients'));
    }

    public function provider_ratings()
    {
        $user    = Auth::guard('web')->user();
        $reviews = RateUser::with('user')->where('provider_id', $user->id)->paginate(10);
        // return $user;
        return view('provider.provider_reviews', compact('user', 'reviews'));
    }
    public function reply_review(Request $request)
    {
        $id        = request('id');
        $validator = Validator::make($request->all(), [
            'reply' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        RateUser::where('id', $id)->update(['reply' => $request->reply]);
        return redirect()->back()->with('success', 'تم الرد بنجاح');
        // return $request;
    }
    public function make_rate(Request $request)
    {
        $request->validate([
            'provider_id' => 'required|exists:users,id',
            'rate'        => 'required',
            'comment'     => 'nullable|string|max:500',
        ]);
        // return $request;

        RateUser::create([
            'user_id'     => auth()->guard('web')->id(),
            'provider_id' => $request->provider_id,
            'rate'        => $request->rate,
            'comment'     => $request->comment,
            // 'status'      => 1,
        ]);

        return back()->with('success', 'Thank you for rating this doctor!');
    }
}
