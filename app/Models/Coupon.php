<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = [
        'code',
        'discount_percent',
        'min_order',
        'usage_limit',
        'used_count',
        'status',
        'starts_at',
        'expires_at',
    ];
    protected $table = 'coupons';
    protected $casts = [
        'status'     => 'boolean',
        'starts_at'  => 'datetime',
        'expires_at' => 'datetime',
    ];

}
