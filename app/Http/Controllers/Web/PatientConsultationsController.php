<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientConsultationsController extends Controller
{
    // View all consultations
    public function myConsultations()
    {
        $patient = Auth::guard('web')->user();
        $consultations = Consultation::with(['doctor', 'doctor.specialist'])
            ->where('patient_id', $patient->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('patient.consultations.index', compact('consultations'));
    }

    // Show payment page
    public function paymentForm($id)
    {
        $patient = Auth::guard('web')->user();
        $consultation = Consultation::with('doctor')
            ->where('id', $id)
            ->where('patient_id', $patient->id)
            ->firstOrFail();

        if ($consultation->is_free || $consultation->payment_status === 'paid') {
            return redirect()->route('patient.consultations.my-bookings')
                ->with('error', 'This consultation does not require payment');
        }

        if ($consultation->status !== 'scheduled') {
            return redirect()->route('patient.consultations.my-bookings')
                ->with('error', 'You cannot pay until the doctor sets the appointment time.');
        }

        return view('patient.consultations.payment', compact('consultation'));
    }

    // Show booking page with doctors list
    public function bookConsultation()
    {
        $patient = Auth::guard('web')->user();

        // Get all active doctors
        $doctors = \App\Models\User::where(function ($query) {
            $query->where('type', 'doctor')
                ->orWhere('role', 'doctor');
        })
            ->where('active', 1)
            ->with('specialist:id,title')
            ->select(
                'id',
                'full_name',
                'f_name',
                'l_name',
                'prof_img',
                'specialization_id',
                'video_consultation_price',
                'call_consultation_price',
                'first_consultation_free'
            )
            ->get();

        return view('patient.consultations.book', compact('doctors'));
    }

    // Process consultation booking
    public function storeBooking(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'type' => 'required|in:video,call',
            'notes' => 'nullable|string',
        ]);

        $patient = Auth::guard('web')->user();
        $doctor = \App\Models\User::findOrFail($request->doctor_id);

        // Check if this is the first consultation
        $previousConsultations = \App\Models\Consultation::where('patient_id', $patient->id)
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

        \App\Models\Consultation::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'type' => $request->type,
            'price' => $price,
            'is_free' => $isFree,
            'notes' => $request->notes,
            'status' => 'pending',
            'payment_status' => $isFree ? 'paid' : 'pending',
        ]);

        return redirect()->route('patient.consultations.my-bookings')
            ->with('success', 'Consultation booked successfully! Wait for the doctor to set the appointment time.');
    }

    // Process payment
    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $patient = Auth::guard('web')->user();
        $consultation = Consultation::where('id', $id)
            ->where('patient_id', $patient->id)
            ->firstOrFail();

        if ($consultation->status !== 'scheduled') {
            return redirect()->route('patient.consultations.my-bookings')
                ->with('error', 'You cannot pay until the doctor sets the appointment time.');
        }

        $consultation->update([
            'payment_status' => 'paid',
            'status' => 'paid',
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('patient.consultations.my-bookings')
            ->with('success', 'Payment successful! Wait for the doctor to set the appointment time.');
    }
}
