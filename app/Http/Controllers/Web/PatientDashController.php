<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Models\Countries;
use App\Models\Town;
use App\Models\UserAllergie;
use App\Models\UserLabol;
use App\Models\UserMedication;
use App\Models\UserNote;
use App\Models\UserSergical;


class PatientDashController extends Controller
{
    //
    public function patients(){
        $patients=User::where('role','patient')->paginate(10);
        return view('patients.inde',compact('patients'));
        // return $patients;
    }

    public function admin_doctors(){
        $doctors = User::where('type','doctor')->paginate(10);
        return view('admin.doctors', compact('doctors'));
    }
    public function change_active(){
        $id=request('id');
        $user=User::where('id',$id)->first();
        $change=$user->update(['active'=>$user->active==1?0:1]);
        if($change==1){
            return redirect()->back()->with('success','Success To Change Status');
        }
        return redirect()->back()->with('error', 'Faild To Change Status');
    }
//     public function patient_profile(){
//         $id=request('id');
// // $user=Auth::guard('web')->user();
//         $patient=User::with('country','usernotes','files')->where('id',$id)->first();
//         return view('Patients.profile',compact('patient'));

//         // return $patient;
//     }
    public function patient_profile()
    {
        $id      = request('id');
        $patient = User::with([
            'country',
            'usernotes',
            'files',
            'town',
        ])->where('id', $id)->first();

        // Load related medical records
        $labData    = UserLabol::where('user_id', $id)->get();
        $medications= UserMedication::where('user_id', $id)->get();
        $surgeries  = UserSergical::where('user_id', $id)->get();
        $allergies  = UserAllergie::where('user_id', $id)->get();
        $countries  = Countries::all();
        $towns      = Town::all();

        return view('Patients.profile', compact(
            'patient', 'labData', 'medications', 'surgeries', 'allergies', 'countries', 'towns'
        ));
    }


//     public function update_profile(Request $request)
// {
//     $id = $request->id;

//     $patient = User::findOrFail($id);

//     $request->validate([
//         'f_name' => 'required|string|max:255',
//         'l_name' => 'nullable|string|max:255',
//         'email' => "required|email|unique:users,email,$id",
//         'phone' => 'nullable|string|max:20',
//         'address' => 'nullable|string|max:255',
//         'gender' => 'nullable|in:male,female',
//         'dob' => 'nullable|date',
//         'prof_img' => 'nullable|image|max:2048',
//         'file' => 'nullable|file|max:10240',
//     ]);


//     $patient->f_name = $request->f_name;
//     $patient->l_name = $request->l_name;
//     $patient->email = $request->email;
//     $patient->phone = $request->phone;
//     $patient->address = $request->address;
//     $patient->gender = $request->gender;
//     $patient->dob = $request->dob;


//     if ($request->hasFile('prof_img')) {

//         if ($patient->prof_img && Storage::disk('public')->exists($patient->prof_img)) {
//             Storage::disk('public')->delete($patient->prof_img);
//         }
//         $path = $request->file('prof_img')->store('profiles', 'public');
//         $patient->prof_img = $path;
//     }

//     $patient->save();


//     if ($request->hasFile('file')) {
//         $filePath = $request->file('file')->store('patient_files', 'public');
//         $patient->files()->create([
//             'file' => $filePath,
//         ]);
//     }

//     return redirect()->route('patient_profile', ['id' => $patient->id])
//         ->with('success', 'Profile updated successfully!');
// }

  public function update_profile(Request $request)
    {
        // return $request;
        $id      = $request->id;
        $patient = User::findOrFail($id);

        $request->validate([
            // Personal
            'f_name'              => 'nullable|string|max:255',
            'm_name'              => 'nullable|string|max:255',
            'l_name'              => 'nullable|string|max:255',
            'email'               => "nullable|email|unique:users,email,$id",
            'phone'               => 'nullable|string|max:20',
            'mobile_number'       => 'nullable|string|max:20',
            'gender'              => 'nullable|in:male,female',
            'dob'                 => 'nullable|string',
            'age'                 => 'nullable|string',
            'country_id'          => 'nullable|exists:countries,id',
            'town_id'             => 'nullable|exists:towns,id',
            'street_name'         => 'nullable|string|max:255',
            'home_number'         => 'nullable|string|max:50',
            'military_status'     => 'nullable|in:active,inactive,veteran',
            'occupation'          => 'nullable|string|max:255',
            'language'            => 'nullable|string',
            'relationship'        => 'nullable|string|max:100',
            'prof_img'            => 'nullable|image',
            // Medical summary fields
            'medications'         => 'nullable|string',
            'allergies'           => 'nullable|string',
            'dnr'                 => 'nullable|string',
            'organ_donation'      => 'nullable|string',
            'chro_ill_conditions' => 'nullable|string',
            'surgical_history'    => 'nullable|string',
            'family_history'      => 'nullable|string',
            'smoking'             => 'nullable|boolean',
            'alcohol'             => 'nullable|boolean',
            'physical_activity'   => 'nullable|boolean',
            'dietary_preferences' => 'nullable|string',
            // Vitals
            'heart_rate'          => 'nullable|string',
            'blood_pressure'      => 'nullable|string',
            'temperature'         => 'nullable|string',
            'respiratory_rate'    => 'nullable|string',
            'oxygen_saturation'   => 'nullable|string',
            'height'              => 'nullable|string',
            'weight'              => 'nullable|string',
            'waist_circumference' => 'nullable|string',
            // Preferences
            'prefered_hospital'   => 'nullable|string',
            'prefered_clinic'     => 'nullable|string',
            'prefered_specialist' => 'nullable|string',
            // Emergency contact
            'p_f_name'            => 'nullable|string|max:100',
            'p_m_name'            => 'nullable|string|max:100',
            'p_l_name'            => 'nullable|string|max:100',
            'p_phone'             => 'nullable|string|max:20',
            'p_email'             => 'nullable|email',
            'p_home'              => 'nullable|string|max:255',
            // Note
            'note'                => 'nullable|string',
            // Lab file
            'file_test'           => 'nullable|file',
            'file_imaging'        => 'nullable|file',
            'file_meds'           => 'nullable|file',
            'file_surgery'        => 'nullable|file',
        ]);

        // ─── Update User table ─────────────────────────────────────
        $userFields = $request->only([
            'f_name','m_name','l_name','email','phone','mobile_number',
            'gender','dob','age','country_id','town_id','street_name',
            'home_number','military_status','occupation','language','relationship',
            'medications','allergies','dnr','organ_donation',
            'chro_ill_conditions','surgical_history','family_history',
            'smoking','alcohol','physical_activity','dietary_preferences',
            'heart_rate','blood_pressure','temperature','respiratory_rate',
            'oxygen_saturation','height','weight','waist_circumference',
            'prefered_hospital','prefered_clinic','prefered_specialist',
            'p_f_name','p_m_name','p_l_name','p_phone','p_email','p_home',
        ]);

        // Filter out null values to avoid integrity constraints
        $userFields = array_filter($userFields, function($value) {
            return !is_null($value);
        });

        if ($request->hasFile('prof_img')) {
            if ($patient->prof_img && Storage::disk('public')->exists($patient->prof_img)) {
                Storage::disk('public')->delete($patient->prof_img);
            }
            $userFields['prof_img'] = $request->file('prof_img')->store('profiles', 'public');
        }

        $patient->fill($userFields)->save();

        // ─── Note ──────────────────────────────────────────────────
        if (! empty($request->note)) {
            UserNote::create(['user_id' => $patient->id, 'note' => $request->note]);
        }

        // ─── Lab data ──────────────────────────────────────────────
        if ($request->filled('test_type') || $request->filled('timeline') || $request->hasFile('file_test') || $request->hasFile('file_imaging')) {
            $labData = [
                'user_id'         => $patient->id,
                'test_type'       => $request->test_type,
                'timeline'        => $request->timeline,
                'date_of_studies' => $request->date_of_studies,
            ];
            if ($request->hasFile('file_test')) {
                $labData['file_test'] = $this->uploadFile($request->file('file_test'), 'patient_files');
            }
            if ($request->hasFile('file_imaging')) {
                $labData['file_imaging'] = $this->uploadFile($request->file('file_imaging'), 'patient_files');
            }
            UserLabol::create($labData);
        }

        // ─── Medication ────────────────────────────────────────────
        if ($request->filled('medication')) {
            $medData = [
                'user_id'           => $patient->id,
                'medication'        => $request->medication,
                'dosage'            => $request->dosage,
                'frequency'         => $request->frequency,
                'pres_provider'     => $request->pres_provider,
                'adverse_reactions' => $request->adverse_reactions,
            ];
            if ($request->hasFile('file_meds')) {
                $medData['file_meds'] = $this->uploadFile($request->file('file_meds'), 'patient_files');
            }
            UserMedication::create($medData);
        }

        // ─── Surgery ───────────────────────────────────────────────
        if ($request->filled('current_treatment')) {
            $surgData = [
                'user_id'             => $patient->id,
                'current_treatment'   => $request->current_treatment,
                'start_date'          => $request->start_date,
                'duration'            => $request->duration,
                'past_procedures'     => $request->past_procedures,
                'surg_date'           => $request->surg_date,
                'surgeon'             => $request->surgeon,
                'outcomes'            => $request->outcomes,
                'reason_for_referral' => $request->reason_for_referral,
                'recommendation'      => $request->recommendation,
            ];
            if ($request->hasFile('file_surgery')) {
                $surgData['file_surgery'] = $this->uploadFile($request->file('file_surgery'), 'patient_files');
            }
            UserSergical::create($surgData);
        }

        // ─── Allergies ─────────────────────────────────────────────
        if ($request->filled('specific_drug') || $request->filled('specific_food') || $request->filled('reaction_details')) {
            UserAllergie::create([
                'user_id'           => $patient->id,
                'specific_drug'     => $request->specific_drug,
                'reaction_details'  => $request->reaction_details,
                'infor_environment' => $request->infor_environment,
                'specific_food'     => $request->specific_food,
                'insur_address'     => $request->insur_address,
                'insur_policy'      => $request->insur_policy,
                'insur_coverage'    => $request->insur_coverage,
                'bill_street_name'  => $request->bill_street_name,
                'bill_town'         => $request->bill_town,
                'bill_number'       => $request->bill_number,
                'preferred_payment' => $request->preferred_payment,
            ]);
        }

        return redirect()->route('patient_profile', ['id' => $patient->id])
            ->with('success', 'Patient profile updated successfully!');
    }
        private function uploadFile($file, $folder = 'files'): string
    {
        $path = $file->store($folder, 'public');
        return $path;
    }


}
