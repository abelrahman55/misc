<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\NursingMakeOffer;
use App\Models\PackageMakeOffer;
use App\Models\Payment;
use App\Models\ProviderMakeOffer;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymobController extends Controller
{
    protected array $offerModels = [
        'package'  => PackageMakeOffer::class,
        'provider' => ProviderMakeOffer::class,
        'nursing'  => NursingMakeOffer::class,
    ];

    /**
     * Handles both Paymob's server-to-server webhook (POST) and the
     * browser redirect back after checkout (GET). Both carry the same
     * transaction payload under the "obj" key.
     */
    public function callback(Request $request, PaymobService $paymob)
    {
        $obj  = (array) $request->input('obj', $request->all());
        $hmac = $request->query('hmac');

        if (! $paymob->verifyHmac($obj, $hmac)) {
            Log::warning('Paymob callback: invalid HMAC', ['payload' => $obj]);
            return $request->isMethod('get')
                ? redirect()->route('my_sick_bookings')->with('error', 'Payment verification failed.')
                : response()->json(['message' => 'invalid hmac'], 400);
        }

        $merchantOrderId = data_get($obj, 'order.merchant_order_id');
        $success         = filter_var(data_get($obj, 'success'), FILTER_VALIDATE_BOOLEAN);

        $payment = Payment::where('merchant_order_id', $merchantOrderId)->first();

        if (! $payment) {
            Log::warning('Paymob callback: unknown merchant_order_id', ['merchant_order_id' => $merchantOrderId]);
            return $request->isMethod('get')
                ? redirect()->route('my_sick_bookings')->with('error', 'Payment record not found.')
                : response()->json(['message' => 'unknown order'], 404);
        }

        if ($payment->status === 'pending') {
            $offerModel = $this->offerModels[$payment->type] ?? null;

            if ($success) {
                $payment->update([
                    'status'          => 'success',
                    'paymob_order_id' => data_get($obj, 'order.id'),
                ]);

                if ($offerModel) {
                    $offerModel::where('id', $payment->offer_id)->update(['paid' => 'success']);
                }
                if ($payment->points_used > 0) {
                    $payment->user?->decrement('points', $payment->points_used);
                }
                if ($payment->coupon_id) {
                    $payment->coupon?->increment('used_count');
                }
            } else {
                $payment->update([
                    'status'          => 'failed',
                    'paymob_order_id' => data_get($obj, 'order.id'),
                ]);

                if ($offerModel) {
                    $offerModel::where('id', $payment->offer_id)->update(['paid' => 'failed']);
                }
            }
        }

        if ($request->isMethod('get')) {
            return $payment->status === 'success'
                ? redirect()->route('my_sick_bookings')->with('success', 'Payment completed successfully!')
                : redirect()->route('my_sick_bookings')->with('error', 'Payment failed.');
        }

        return response()->json(['message' => 'ok']);
    }
}
