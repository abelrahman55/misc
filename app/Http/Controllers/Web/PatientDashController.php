<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PatientDashController extends Controller
{
    //
    public function patients(){
        $patients=User::where('role','patient')->paginate(10);
        return view('patients.inde',compact('patients'));
        // return $patients;
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
    public function patient_profile(){
        $id=request('id');
// $user=Auth::guard('web')->user();
        $patient=User::with('country','usernotes','files')->where('id',$id)->first();
        return view('Patients.profile',compact('patient'));

        // return $patient;
    }

    public function update_profile(Request $request)
{
    $id = $request->id;

    $patient = User::findOrFail($id);

    $request->validate([
        'f_name' => 'required|string|max:255',
        'l_name' => 'nullable|string|max:255',
        'email' => "required|email|unique:users,email,$id",
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'gender' => 'nullable|in:male,female',
        'dob' => 'nullable|date',
        'prof_img' => 'nullable|image|max:2048',
        'file' => 'nullable|file|max:10240',
    ]);


    $patient->f_name = $request->f_name;
    $patient->l_name = $request->l_name;
    $patient->email = $request->email;
    $patient->phone = $request->phone;
    $patient->address = $request->address;
    $patient->gender = $request->gender;
    $patient->dob = $request->dob;


    if ($request->hasFile('prof_img')) {

        if ($patient->prof_img && Storage::disk('public')->exists($patient->prof_img)) {
            Storage::disk('public')->delete($patient->prof_img);
        }
        $path = $request->file('prof_img')->store('profiles', 'public');
        $patient->prof_img = $path;
    }

    $patient->save();

    
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('patient_files', 'public');
        $patient->files()->create([
            'file' => $filePath,
        ]);
    }

    return redirect()->route('patient_profile', ['id' => $patient->id])
        ->with('success', 'Profile updated successfully!');
}

}
