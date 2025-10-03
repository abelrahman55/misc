<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Api\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    //
    public function patient_data(){
        $data=PatientService::GetPatientData();
        return $data;
    }
    public function assign_role(){
        User::where('email','admin@gmail.com')->first()->assignRole('admin');
        return 're';
    }
    public function admin_patients(){
        $patients=User::where('role','patient')->paginate(10);
        // return $patients;
        return view('admin_patients',compact('patients'));
    }
    public function log_out(Request $request)
{
    Auth::guard('web')->logout();

    // لو عايز تمسح الـ session كمان
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin_login');
    // رجّع رد (API) أو رجوع للصفحة الرئيسية حسب نوع المشروع
    // return response()->json(['message' => 'Logged out successfully']);
    // أو مثلاً:
    // return redirect('/login');
}
}
