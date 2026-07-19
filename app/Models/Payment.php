<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable = [
        'merchant_order_id',
        'type',
        'booking_id',
        'offer_id',
        'user_id',
        'amount',
        'coupon_id',
        'points_used',
        'status',
        'paymob_order_id',
    ];

    public $casts = [
        'amount'      => 'float',
        'points_used' => 'int',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}
