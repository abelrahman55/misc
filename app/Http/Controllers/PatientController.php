<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Api\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    //
    public function patient_data()
    {
        $data = PatientService::GetPatientData();
        return $data;
    }
    public function assign_role()
    {
        // User::where('email', 'doctor@gmail.com')->update(['role' => 'doctor']);
        User::where('email', 'patien43t@gmail.com')->first()->assignRole('doctor');
        return 're';
    }
    public function admin_patients()
    {
        $patients = User::where('role', 'patient')->paginate(10);
        // return $patients;
        return view('admin_patients', compact('patients'));
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
    public function update_physical_data(Request $request)
    {
        $user = Auth::guard('user')->user();

        $validatedData = $request->validate([
            'heart_rate' => 'nullable',
            'blood_pressure' => 'nullable|numeric|min:0',
            'temperature' => 'nullable|string|max:3',
            'respiratory_rate' => 'nullable|string|max:255',
            'oxygen_saturation' => 'nullable|string|max:255',
        ]);

        // تحديث بيانات المستخدم
        $user->heart_rate = $validatedData['heart_rate'] ?? $user->heart_rate;
        $user->blood_pressure = $validatedData['blood_pressure'] ?? $user->blood_pressure;
        $user->temperature = $validatedData['temperature'] ?? $user->temperature;
        $user->respiratory_rate = $validatedData['respiratory_rate'] ?? $user->respiratory_rate;
        $user->oxygen_saturation = $validatedData['oxygen_saturation'] ?? $user->oxygen_saturation;
        $user->save();

        return response()->json(['message' => 'Physical data updated successfully', 'data' => $user]);
    }
}
