<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BookingHospital;
use App\Models\BookingNursingProvider;
use App\Models\BookingProvider;
use App\Models\Coupon;
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
        $user = Auth::guard('web')->user();

        // 🔹 1. التحقق من المدخلات
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_nursing_providers,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        // 🔹 2. تحميل الحجز والعرض
        $booking = BookingNursingProvider::with('offer')->findOrFail($data['booking_id']);
        $amount  = $booking->offer->provider_price ?? 0;

        // 🔹 3. التحقق من الكوبون أولاً قبل أي خصم أو نقاط
        $coupon = null;
        if (! empty($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            // 🧠 تحقق من وجود الكوبون أولاً
            if (! $coupon) {
                return back()->with('error', 'Invalid coupon code.');
            }

            // 🧠 تحقق من حالة التفعيل
            if ($coupon->status != 1) {
                return back()->with('error', 'This coupon is inactive.');
            }

            // 🧠 تحقق من تاريخ البداية والنهاية
            if ($coupon->starts_at && $coupon->starts_at->isFuture()) {
                return back()->with('error', 'This coupon is not yet active.');
            }

            if ($coupon->expires_at && $coupon->expires_at->isPast()) {
                return back()->with('error', 'This coupon has expired.');
            }

            // 🧠 تحقق من عدد مرات الاستخدام
            if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
                return back()->with('error', 'This coupon has reached its usage limit.');
            }

            // 🧠 تحقق من الحد الأدنى للطلب
            if ($coupon->min_order && $amount < $coupon->min_order) {
                return back()->with('error', 'Minimum order amount not met for this coupon.');
            }

            // ✅ لو الكوبون صالح → طبق الخصم
            $discount = $amount * ($coupon->discount_percent / 100);
            $amount -= $discount;

            // زود عداد الاستخدام بعد الدفع لاحقاً (هنحدثه بعد نجاح العملية)
        }

        // 🔹 4. استخدام النقاط
        if ($request->has('use_points') && $request->boolean('use_points') === true) {
            $points = $user->points ?? 0;
            if ($points > 0) {
                $deduct = min($points, $amount);
                $amount -= $deduct;
                $user->points -= $deduct;
                $user->save();
            }
        }

        // 🔹 5. عملية الدفع (مثال تجريبي)
        $booking->update([
            'is_paid'     => true,
            'paid_amount' => $amount,
        ]);

        // 🔹 6. لو في كوبون تم استخدامه فعلاً، زود عداد الاستخدام
        if ($coupon) {
            $coupon->increment('used_count');
        }

        return back()->with('success', 'Payment completed successfully!');
    }
    public function package_pay(Request $request)
    {
        $user = Auth::guard('web')->user();

        // 🔹 1. التحقق من المدخلات
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_provider,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        // 🔹 2. تحميل الحجز والعرض
        $booking = BookingProvider::with('offer')->findOrFail($data['booking_id']);
        $amount  = $booking->offer->provider_price ?? 0;

        // 🔹 3. التحقق من الكوبون أولاً قبل أي خصم أو نقاط
        $coupon = null;
        if (! empty($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            // 🧠 تحقق من وجود الكوبون أولاً
            if (! $coupon) {
                return back()->with('error', 'Invalid coupon code.');
            }

            // 🧠 تحقق من حالة التفعيل
            if ($coupon->status != 1) {
                return back()->with('error', 'This coupon is inactive.');
            }

            // 🧠 تحقق من تاريخ البداية والنهاية
            if ($coupon->starts_at && $coupon->starts_at->isFuture()) {
                return back()->with('error', 'This coupon is not yet active.');
            }

            if ($coupon->expires_at && $coupon->expires_at->isPast()) {
                return back()->with('error', 'This coupon has expired.');
            }

            // 🧠 تحقق من عدد مرات الاستخدام
            if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
                return back()->with('error', 'This coupon has reached its usage limit.');
            }

            // 🧠 تحقق من الحد الأدنى للطلب
            if ($coupon->min_order && $amount < $coupon->min_order) {
                return back()->with('error', 'Minimum order amount not met for this coupon.');
            }

            // ✅ لو الكوبون صالح → طبق الخصم
            $discount = $amount * ($coupon->discount_percent / 100);
            $amount -= $discount;

            // زود عداد الاستخدام بعد الدفع لاحقاً (هنحدثه بعد نجاح العملية)
        }

        // 🔹 4. استخدام النقاط
        if ($request->has('use_points') && $request->boolean('use_points') === true) {
            $points = $user->points ?? 0;
            if ($points > 0) {
                $deduct = min($points, $amount);
                $amount -= $deduct;
                $user->points -= $deduct;
                $user->save();
            }
        }

        // 🔹 5. عملية الدفع (مثال تجريبي)
        $booking->update([
            'is_paid'     => true,
            'paid_amount' => $amount,
        ]);

        // 🔹 6. لو في كوبون تم استخدامه فعلاً، زود عداد الاستخدام
        if ($coupon) {
            $coupon->increment('used_count');
        }

        return back()->with('success', 'Payment completed successfully!');
    }

    public function provider_pay(Request $request)
    {
        $user = Auth::guard('web')->user();

        // 🔹 1. التحقق من المدخلات
        $data = $request->validate([
            'booking_id'  => 'required|exists:booking_hospitals,id',
            'coupon_code' => 'nullable|string',
            'use_points'  => 'nullable|boolean',
        ]);

        // 🔹 2. تحميل الحجز والعرض
        $booking = BookingProvider::with('offer')->findOrFail($data['booking_id']);
        $amount  = $booking->offer->provider_price ?? 0;

        // 🔹 3. التحقق من الكوبون أولاً قبل أي خصم أو نقاط
        $coupon = null;
        if (! empty($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            // 🧠 تحقق من وجود الكوبون أولاً
            if (! $coupon) {
                return back()->with('error', 'Invalid coupon code.');
            }

            // 🧠 تحقق من حالة التفعيل
            if ($coupon->status != 1) {
                return back()->with('error', 'This coupon is inactive.');
            }

            // 🧠 تحقق من تاريخ البداية والنهاية
            if ($coupon->starts_at && $coupon->starts_at->isFuture()) {
                return back()->with('error', 'This coupon is not yet active.');
            }

            if ($coupon->expires_at && $coupon->expires_at->isPast()) {
                return back()->with('error', 'This coupon has expired.');
            }

            // 🧠 تحقق من عدد مرات الاستخدام
            if ($coupon->usage_limit !== null && $coupon->used_count >= $coupon->usage_limit) {
                return back()->with('error', 'This coupon has reached its usage limit.');
            }

            // 🧠 تحقق من الحد الأدنى للطلب
            if ($coupon->min_order && $amount < $coupon->min_order) {
                return back()->with('error', 'Minimum order amount not met for this coupon.');
            }

            // ✅ لو الكوبون صالح → طبق الخصم
            $discount = $amount * ($coupon->discount_percent / 100);
            $amount -= $discount;

            // زود عداد الاستخدام بعد الدفع لاحقاً (هنحدثه بعد نجاح العملية)
        }

        // 🔹 4. استخدام النقاط
        if ($request->has('use_points') && $request->boolean('use_points') === true) {
            $points = $user->points ?? 0;
            if ($points > 0) {
                $deduct = min($points, $amount);
                $amount -= $deduct;
                $user->points -= $deduct;
                $user->save();
            }
        }

        // 🔹 5. عملية الدفع (مثال تجريبي)
        $booking->update([
            'is_paid'     => true,
            'paid_amount' => $amount,
        ]);

        // 🔹 6. لو في كوبون تم استخدامه فعلاً، زود عداد الاستخدام
        if ($coupon) {
            $coupon->increment('used_count');
        }

        return back()->with('success', 'Payment completed successfully!');
    }

}
