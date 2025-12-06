<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageMakeOffer extends Model
{
    //
    public $fillable = ['provider_price', 'paid', 'booking_id', 'provider_id', 'user_id'];

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
        return $this->belongsTo(BookingProvider::class, 'booking_id');
    }
}
