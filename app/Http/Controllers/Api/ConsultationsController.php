<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    // Patient books a consultation
    public function book(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'type' => 'required|in:video,call',
            'notes' => 'nullable|string',
        ]);

        $patient = auth()->guard('users')->user();
        $doctor = User::findOrFail($request->doctor_id);

        // Check if this is the first consultation
        $previousConsultations = Consultation::where('patient_id', $patient->id)
            ->where('doctor_id', $doctor->id)
            ->count();

        $isFirstConsultation = $previousConsultations == 0;

        // Determine price
        $price = 0;
        $isFree = false;

        if ($isFirstConsultation && $doctor->first_consultation_free) {
            $isFree = true;
            $price = 0;
        } else {
            $price = $request->type === 'video'
                ? $doctor->video_consultation_price
                : $doctor->call_consultation_price;
        }


        $consultation = Consultation::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'type' => $request->type,
            'price' => $price,
            'is_free' => $isFree,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => $isFree ? 'paid' : 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Consultation booked successfully',
            'data' => $consultation->load('doctor:id,full_name,prof_img,specialization_id'),
        ]);
    }

    // Patient views their consultations
    public function myConsultations(Request $request)
    {
        $patient = auth()->guard('users')->user();

        $consultations = Consultation::with(['doctor:id,full_name,prof_img,specialization_id', 'doctor.specialist:id,title'])
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $consultations,
        ]);
    }

    // Patient makes payment
    public function pay(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $patient = auth()->guard('users')->user();
        $consultation = Consultation::where('id', $id)
            ->where('patient_id', $patient->id)
            ->firstOrFail();

        if ($consultation->is_free) {
            return response()->json([
                'success' => false,
                'message' => 'This consultation is free, no payment needed',
            ], 400);
        }

        if ($consultation->payment_status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Consultation already paid',
            ], 400);
        }

        if ($consultation->status !== 'scheduled') {
            return response()->json([
                'success' => false,
                'message' => 'You cannot pay until the doctor sets the appointment time.',
            ], 400);
        }

        // Update consultation payment status
        $consultation->update([
            'payment_status' => 'paid',
            'status' => 'paid',
            'payment_method' => $request->payment_method,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
            'data' => $consultation,
        ]);
    }

    // Get consultation details (for call/video)
    public function getCallDetails($id)
    {
        $patient = auth()->guard('users')->user();
        $consultation = Consultation::with('doctor:id,full_name,prof_img')
            ->where('id', $id)
            ->where('patient_id', $patient->id)
            ->firstOrFail();

        if ($consultation->payment_status !== 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Payment required before accessing consultation',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'consultation' => $consultation,
                'meeting_link' => $consultation->meeting_link,
                'doctor' => $consultation->doctor,
            ],
        ]);
    }
}
