<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class DoctorConsultationsController extends Controller
{
    // Set consultation prices
    public function setConsultationPrices(Request $request)
    {
        $request->validate([
            'video_consultation_price' => 'required|numeric|min:0',
            'call_consultation_price' => 'required|numeric|min:0',
            'first_consultation_free' => 'boolean',
        ]);

        $doctor = auth()->guard('users')->user();

        $doctor->update([
            'video_consultation_price' => $request->video_consultation_price,
            'call_consultation_price' => $request->call_consultation_price,
            'first_consultation_free' => $request->first_consultation_free ?? true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultation prices updated successfully',
            'data' => [
                'video_consultation_price' => $doctor->video_consultation_price,
                'call_consultation_price' => $doctor->call_consultation_price,
                'first_consultation_free' => $doctor->first_consultation_free,
            ],
        ]);
    }

    // View doctor's consultations
    public function myConsultations(Request $request)
    {
        $doctor = auth()->guard('users')->user();

        $status = $request->query('status'); // pending, scheduled, paid, completed, cancelled

        $query = Consultation::with(['patient:id,full_name,f_name,l_name,prof_img,phone'])
            ->where('doctor_id', $doctor->id)
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }

        $consultations = $query->get();

        return response()->json([
            'success' => true,
            'data' => $consultations,
        ]);
    }

    // Set appointment time
    public function setAppointmentTime(Request $request)
    {
        $request->validate([
            'consultation_id' => 'required|exists:consultations,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'meeting_link' => 'nullable|url',
        ]);

        $doctor = auth()->guard('users')->user();
        $consultation = Consultation::where('id', $request->consultation_id)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        $consultation->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'meeting_link' => $request->meeting_link,
            'status' => 'scheduled',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Appointment time set successfully',
            'data' => $consultation->load('patient:id,full_name,phone'),
        ]);
    }

    // Mark consultation as completed
    public function markAsCompleted(Request $request, $id)
    {
        $doctor = auth()->guard('users')->user();
        $consultation = Consultation::where('id', $id)
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        $consultation->update(['status' => 'completed']);

        return response()->json([
            'success' => true,
            'message' => 'Consultation marked as completed',
        ]);
    }
}
