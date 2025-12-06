<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use Illuminate\Support\Facades\Auth;

class ProviderReservationsController extends Controller
{
    //
    public function provider_reservations()
    {
        $user     = Auth::guard('web')->user();
        $user     = Auth::guard('web')->user();
        $bookings = BookingHospital::with('package', 'offer')
            ->where('provider_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('provider_reservations', compact('bookings'));
        return $bookings;
    }
}
