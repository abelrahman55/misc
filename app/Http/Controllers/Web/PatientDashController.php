<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('patients.profile',compact('patient'));

        // return $patient;
    }
}
