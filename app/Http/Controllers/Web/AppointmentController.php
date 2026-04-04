<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['client', 'doctor', 'treatmentservice', 'specialty', 'country'])->paginate(15);
        return view('dashboard.appointments.index', compact('appointments'));
    }

    public function myAppointments()
    {
        $userId = Auth::guard('web')->id();
        $appointments = Appointment::where('client_id', $userId)
            ->with(['doctor', 'treatmentservice', 'specialty', 'country'])
            ->orderBy('appoint_date', 'desc')
            ->paginate(15);

        return view('dashboard.patient.appointments.index', compact('appointments'));
    }

    public function assignedAppointments()
    {
        $doctorId = Auth::guard('web')->id();
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with(['client', 'treatmentservice', 'specialty', 'country', 'package'])
            ->orderBy('appoint_date', 'desc')
            ->paginate(15);

        return view('doctor.appointments.index', compact('appointments'));
    }
}
