<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorConsultationsController extends Controller
{
    // Show pricing settings page
    public function pricingSettings()
    {
        $doctor = Auth::guard('web')->user();
        return view('doctor.consultations.pricing', compact('doctor'));
    }

    // Update pricing settings
    public function updatePricing(Request $request)
    {
        // return $request;
        $request->validate([
            'video_consultation_price' => 'required|numeric|min:0',
            'call_consultation_price' => 'required|numeric|min:0',
            'first_consultation_free' => 'nullable',
        ]);

        $doctor = Auth::guard('web')->user();
        $doctor->update([
            'video_consultation_price' => $request->video_consultation_price,
            'call_consultation_price' => $request->call_consultation_price,
            'first_consultation_free' => $request->has('first_consultation_free'),
        ]);
        
        if(request()->input('first_consultation_free')){
            if(request()->input('first_consultation_free')=='on'){
                $doctor->update([
            'video_consultation_price' => $request->video_consultation_price,
            'call_consultation_price' => $request->call_consultation_price,
            'first_consultation_free' => 1,
        ]);
            }
            else {
                  $doctor->update([
            'video_consultation_price' => $request->video_consultation_price,
            'call_consultation_price' => $request->call_consultation_price,
            'first_consultation_free' => 0,
        ]);
            }
        }

        return redirect()->back()->with('success', 'Consultation prices updated successfully');
    }

    // View all consultations
    public function doctorConsultations(Request $request)
    {
        $doctor = Auth::guard('web')->user();
        $status = $request->query('status');

        $query = Consultation::with(['patient'])
            ->where('doctor_id', $doctor->id)
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $consultations = $query->paginate(10);

        return view('doctor.consultations.index', compact('consultations', 'status'));
    }

    // Show appointment form
    public function setAppointmentForm($id)
    {
        $doctor = Auth::guard('web')->user();
        $consultation = Consultation::with('patient')
            ->where('id', $id)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        return view('doctor.consultations.set_appointment', compact('consultation'));
    }

    // Save appointment
    public function saveAppointment(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'meeting_link' => 'nullable|url',
        ]);

        $doctor = Auth::guard('web')->user();
        $consultation = Consultation::where('id', $id)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        $consultation->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'meeting_link' => $request->meeting_link,
            'status' => 'scheduled',
        ]);

        return redirect()->route('doctor.consultations.index')->with('success', 'Appointment time set successfully');
    }
}
