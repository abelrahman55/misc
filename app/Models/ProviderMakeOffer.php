<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProviderMakeOffer extends Model
{
    //
    public $fillable = ['provider_price', 'booking_id', 'provider_id', 'user_id', 'paid'];

    public $casts = [
        'provider_price' => 'float',
        'booking_id'     => 'int',
        'provider_id'    => 'int',
        'user_id'        => 'int',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function booking()
    {
        return $this->belongsTo(BookingHospital::class, 'booking_id');
    }
}
