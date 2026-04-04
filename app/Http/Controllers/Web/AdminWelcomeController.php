<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\BookingNursingProvider;
use App\Models\BookingProvider;
use App\Models\Package;
use App\Models\PackageHospital;
use App\Models\PackageNursing;
use App\Models\User;

class AdminWelcomeController extends Controller
{
    //
    public function welcome()
    {
        $doctors   = User::where('role', 'doctor')->where('type', 'doctor')->count();
        $hospitals = User::where('role', 'doctor')->where('type', 'hospital')->count();
        $hotels    = User::where('role', 'doctor')->where('type', 'hotel')->count();
        $patients  = User::where('role', 'patient')->count();

        $nursing_packages  = PackageNursing::count();
        $packages          = Package::count();
        $provider_packages = PackageHospital::count();

        $packages_bookings = BookingProvider::count();
        $nursing_bookings  = BookingNursingProvider::count();
        $provider_bookings = BookingHospital::count();
        $reservations = BookingNursingProvider::with('user', 'messages')
            ->addSelect(['last_message_at' => \App\Models\NursingPackageMessage::select('created_at')
                ->whereColumn('book_package_id', 'booking_nursing_providers.id')
                ->latest()
                ->take(1)
            ])
            ->orderByDesc('last_message_at')
            ->paginate(10);

        $hospital_reservations = BookingHospital::with('user', 'messages_by_last')
            ->addSelect(['last_message_at' => \App\Models\HospitalPackageMessage::select('created_at')
                ->whereColumn('book_package_id', 'booking_hospitals.id')
                ->latest()
                ->take(1)
            ])
            ->orderByDesc('last_message_at')
            ->paginate(10);

        return view('welcome', compact(
            'nursing_packages', 'packages', 'doctors', 'hospitals', 'hotels', 'patients',
            'packages_bookings', 'nursing_bookings', 'provider_bookings', 
            'reservations', 'hospital_reservations'
        ));
    }
}
