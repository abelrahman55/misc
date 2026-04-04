<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\DoctorFile;
use App\Models\PackageMakeMeeting;
use App\Models\ProviderMakeMeeting;
use App\Models\RateUser;
use App\Models\User;
use App\Models\UserNote;
use App\Models\Countries;
use App\Models\Specialty;
use App\Models\Town;
use App\Models\UserLicense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class ProvidersController extends Controller
{
    public function provider_profile()
    {
        $user = Auth::guard('web')->user();
        $user = User::with([
            'country',
            'usernotes',
            'files',
            'specialist',
            'medicalStaffs',
            'licenses',
            'town',
        ])->where('id', $user->id)->first();

        $specialties = Specialty::active()->get();
        $countries   = Countries::all();
        $towns       = Town::all();

        return view('provider.provider_profile', compact('user', 'specialties', 'countries', 'towns'));
    }

    public function welcome_provider()
    {
        $user = Auth::guard('web')->user();
        $hospitalBookings = BookingHospital::with(['provider', 'package', 'offer'])
            ->where('provider_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'hospital_page');

        $meetings = ProviderMakeMeeting::with(['doctor', 'user'])
            ->where('doctor_id', $user->id)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(5, ['*'], 'meetings_page');

        return view('provider_dash', compact('hospitalBookings', 'meetings'));
    }

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
            'prof_img' => 'nullable|image|mimes:jpg,jpeg,png',
            'file'     => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx',
            
            // New fields from synchronized form
            'legal_business_name' => 'nullable|string',
            'healthcare_facility_type' => 'nullable|string',
            'town_id' => 'nullable|exists:towns,id',
            'main_point_contact' => 'nullable|string',
            'website' => 'nullable|string',
            'content_blog' => 'nullable|string',
            'service_offered' => 'nullable|string',
            'specialization_id' => 'nullable|exists:specialties,id',
            'pricing_information' => 'nullable|string',
            'technology' => 'nullable|string',
            'quality' => 'nullable|string',
            'preferred_partnership' => 'nullable|string',
            'facebook_link' => 'nullable|string',
            'twitter_link' => 'nullable|string',
            'linkedin_link' => 'nullable|string',
            'tiktok_link' => 'nullable|string',

            // Medical Staffs
            'medical_staffs' => 'nullable|array',
            'medical_staffs.*.name' => 'required_with:medical_staffs|string',
            'medical_staffs.*.qualification' => 'nullable|string',
            'medical_staffs.*.experience_years' => 'nullable|string',
            'medical_staffs.*.specialization' => 'nullable|string',

            // Licenses validation
            'licenses' => 'nullable|array',
            'licenses.*' => 'nullable|array',
            'licenses.*.*' => 'file|mimes:pdf,jpg,jpeg,png,mp4,avi,mov,doc,docx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // Handle Profile Image
        if ($request->hasFile('prof_img')) {
            if ($user->prof_img && file_exists(public_path('storage/' . $user->prof_img))) {
                unlink(public_path('storage/' . $user->prof_img));
            }
            $path = uploadFile($request->file('prof_img'), 'profile_images');
            $data['prof_img'] = $path;
        }

        // Update User Model (Exclude non-user fields)
        $userData = collect($data)->except(['medical_staffs', 'licenses', 'file'])->toArray();
        $user->update($userData);

        // Handle Medical Staffs (Replace all)
        if ($request->has('medical_staffs')) {
            $user->medicalStaffs()->delete();
            foreach ($request->medical_staffs as $staff) {
                if (!empty($staff['name'])) {
                    $user->medicalStaffs()->create($staff);
                }
            }
        }

        // Handle Licenses & Certifications (Append new ones)
        if ($request->file('licenses')) {
            
            $allLicenses = $request->file('licenses');
            foreach ($allLicenses as $type => $files) {
               
                // In case it's a single file or array of files
                $fileArray = is_array($files) ? $files : [$files];
                foreach ($fileArray as $file) {
                   
                    if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
                        
                        // Store in a type-specific folder
                        $path = uploadFile($file, 'licenses/' . $type);
                        
                        $user->licenses()->create([
                            'file' => $path,
                            'type' => $type,
                        ]);
                    }
                }
            }
        }

        // Handle General File Upload (backward compatibility or extra files)
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = public_path('storage/files');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            DoctorFile::create([
                'user_id' => $user->id,
                'file'    => 'files/' . $fileName,
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function delete_file()
    {
        $id = request('id');
        $file = DoctorFile::find($id);
        if ($file) {
            if (file_exists(public_path('storage/' . $file->file))) {
                unlink(public_path('storage/' . $file->file));
            }
            $file->delete();
        }
        return redirect()->back()->with('success', 'تم المسح بنجاح');
    }

    public function delete_license($id)
    {
        $license = UserLicense::findOrFail($id);
        
        // Delete the physical file if it exists
        if ($license->file && Storage::disk('public')->exists($license->file)) {
            Storage::disk('public')->delete($license->file);
        }

        $license->delete();

        return redirect()->back()->with('success', 'تم حذف الترخيص بنجاح');
    }

    public function update_provider_profile($id)
    {
        $user = User::with([
            'country',
            'usernotes',
            'files',
            'specialist',
            'medicalStaffs',
            'licenses',
            'town',
        ])->where('id', $id)->first();

        $specialties = Specialty::active()->get();
        $countries   = Countries::all();
        $towns       = Town::all();

        return view('provider.provider_profile', compact('user', 'specialties', 'countries', 'towns'));
    }

    public function add_note(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = Auth::guard('web')->user();
        $data = $validator->validated();
        $data['user_id'] = $user->id;
        UserNote::create($data);
        return redirect()->back()->with('success', 'تمت الاضافه بنجاح');
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
        return view('provider.provider_reviews', compact('user', 'reviews'));
    }

    public function reply_review(Request $request)
    {
        $id = request('id');
        $validator = Validator::make($request->all(), [
            'reply' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        RateUser::where('id', $id)->update(['reply' => $request->reply]);
        return redirect()->back()->with('success', 'تم الرد بنجاح');
    }

    public function make_rate(Request $request)
    {
        $request->validate([
            'provider_id' => 'required|exists:users,id',
            'rate'        => 'required',
            'comment'     => 'nullable|string|max:500',
        ]);

        RateUser::create([
            'user_id'     => Auth::guard('web')->id(),
            'provider_id' => $request->provider_id,
            'rate'        => $request->rate,
            'comment'     => $request->comment,
        ]);

        return back()->with('success', 'Thank you for rating!');
    }
}
