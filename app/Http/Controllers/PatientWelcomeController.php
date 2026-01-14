<?php
namespace App\Http\Controllers;

use App\Models\BookingHospital;
use App\Models\BookingNursingProvider;
use App\Models\BookingProvider;
use App\Models\PackageMakeMeeting;

class PatientWelcomeController extends Controller
{
    //
    public function patient_welcome()
    {
        $userId = auth()->guard('web')->id(); // المريض الحالي

        // 🔵 Meetings Pagination
        $meetings = PackageMakeMeeting::with(['doctor', 'user'])
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(5, ['*'], 'meetings_page');
        // return $meetings;
        // 🟢 Hospital Bookings
        $hospitalBookings = BookingHospital::with(['provider', 'package', 'offer'])
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'hospital_page');
        // return $hospitalBookings;
        // 🟣 Nursing Bookings
        $nursingBookings = BookingNursingProvider::with(['provider', 'package', 'offer'])
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'nursing_page');

        // 🟠 Provider Bookings
        $providerBookings = BookingProvider::with(['provider', 'package', 'offer'])
            ->where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'provider_page');
        // return $providerBookings;

        return view('patient_welcome', compact(
            'meetings',
            'hospitalBookings',
            'nursingBookings',
            'providerBookings'
        ));
    }
    public function welcome_doctor()
    {
        $userId = auth()->guard('web')->id(); // المريض الحالي
                                              // return $userId;
                                              // 🔵 Meetings Pagination
        $meetings = PackageMakeMeeting::with(['doctor', 'user', 'offer'])
            ->where('doctor_id', $userId)
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(5, ['*'], 'meetings_page');

        $providerBookings = BookingProvider::with(['provider', 'package', 'offer'])
            ->where('provider_id', $userId)
            ->orderBy('date', 'desc')
            ->paginate(5, ['*'], 'provider_page');
        // return $providerBookings;

        return view('welcome_doctor', compact(
            'meetings',
            'providerBookings'
        ));
    }

}
