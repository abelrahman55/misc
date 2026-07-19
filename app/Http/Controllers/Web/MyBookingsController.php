<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\BookingNursingProvider;
use App\Models\BookingProvider;
use App\Models\Coupon;
use App\Models\Payment;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBookingsController extends Controller
{
    //
    public function my_nursing_bookings()
    {
        $user     = Auth::guard('web')->user();
        $bookings = BookingNursingProvider::with('package', 'offer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('my_nursing_bookings.index', compact('bookings', 'user'));
    }
    public function my_provider_bookings()
    {
        $user     = Auth::guard('web')->user();
        $bookings = BookingHospital::with('package', 'offer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        // return $bookings;
        return view('my_provider_bookings.index', compact('bookings', 'user'));
    }

    public function my_sick_bookings()
    {
        $user     = Auth::guard('web')->user();
        $bookings = BookingProvider::with('package', 'offer')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('my_sick_bookings.index', compact('bookings', 'user'));
    }

    public function nursing_pay(Request $request)
    {
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_nursing_providers,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        return $this->initiatePayment($request, $data, 'nursing', BookingNursingProvider::class);
    }

    public function package_pay(Request $request)
    {
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_provider,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        return $this->initiatePayment($request, $data, 'package', BookingProvider::class);
    }

    public function provider_pay(Request $request)
    {
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_hospitals,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        return $this->initiatePayment($request, $data, 'provider', BookingHospital::class);
    }

    /**
     * Shared flow for the three pay actions: validate coupon/points, then hand off
     * to Paymob instead of marking the booking paid directly. The offer's `paid`
     * status is only flipped to success/failed once Paymob confirms via callback.
     */
    protected function initiatePayment(Request $request, array $data, string $type, string $bookingModelClass)
    {
        $user    = Auth::guard('web')->user();
        $booking = $bookingModelClass::with('offer')->findOrFail($data['booking_id']);

        if (! $booking->offer) {
            return back()->with('error', 'No offer found for this booking yet.');
        }

        $amount = (float) ($booking->offer->provider_price ?? 0);

        $coupon = null;
        if (! empty($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            if (! $coupon) {
                return back()->with('error', 'Invalid coupon code.');
            }
            if ($coupon->status != 1) {
                return back()->with('error', 'This coupon is inactive.');
            }
            if ($coupon->starts_at && $coupon->starts_at->isFuture()) {
                return back()->with('error', 'This coupon is not yet active.');
            }
            if ($coupon->expires_at && $coupon->expires_at->isPast()) {
                return back()->with('error', 'This coupon has expired.');
            }
            if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
                return back()->with('error', 'This coupon has reached its usage limit.');
            }
            if ($coupon->min_order && $amount < $coupon->min_order) {
                return back()->with('error', 'Minimum order amount not met for this coupon.');
            }

            $amount -= $amount * ($coupon->discount_percent / 100);
        }

        $pointsUsed = 0;
        if ($request->boolean('use_points')) {
            $points = $user->points ?? 0;
            if ($points > 0) {
                $pointsUsed = min($points, $amount);
                $amount -= $pointsUsed;
            }
        }

        // Nothing left to charge (fully covered by points/coupon) — settle immediately, no need for Paymob.
        if ($amount <= 0) {
            $booking->offer->update(['paid' => 'success']);

            if ($pointsUsed > 0) {
                $user->decrement('points', $pointsUsed);
            }
            if ($coupon) {
                $coupon->increment('used_count');
            }

            return back()->with('success', 'Payment completed successfully!');
        }

        $merchantOrderId = strtoupper($type) . '_' . $booking->id . '_' . uniqid();

        $payment = Payment::create([
            'merchant_order_id' => $merchantOrderId,
            'type'              => $type,
            'booking_id'        => $booking->id,
            'offer_id'          => $booking->offer->id,
            'user_id'           => $user->id,
            'amount'            => $amount,
            'coupon_id'         => $coupon->id ?? null,
            'points_used'       => (int) $pointsUsed,
            'status'            => 'pending',
        ]);

        $billingData = [
            'apartment'     => 'NA',
            'floor'         => 'NA',
            'street'        => 'NA',
            'building'      => 'NA',
            'shipping_method' => 'NA',
            'postal_code'   => 'NA',
            'city'          => 'NA',
            'country'       => 'NA',
            'state'         => 'NA',
            'first_name'    => $user->f_name ?? 'NA',
            'last_name'     => $user->l_name ?? 'NA',
            'email'         => $user->email ?? 'na@na.com',
            'phone_number'  => $user->phone ?? 'NA',
        ];

        try {
            $iframeUrl = app(PaymobService::class)->getIframeUrl($amount, $billingData, $merchantOrderId);
        } catch (\Throwable $e) {
            $payment->update(['status' => 'failed']);
            report($e);
            return back()->with('error', 'Could not start the payment, please try again.');
        }

        return redirect()->away($iframeUrl);
    }
}
