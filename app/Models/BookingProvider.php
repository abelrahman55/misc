<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingProvider extends Model
{
    //
    public $table    = 'booking_provider';
    public $fillable = [
        'package_id',
        'provider_id',
        'user_id',
        'date',
    ];
    public $casts = [
        'package_id'  => 'int',
        'provider_id' => 'int',
        'user_id'     => 'int',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
    public function options()
    {
        return $this->hasMany(BookingProviderOption::class, 'booking_id');
    }
    public function messages()
    {
        return $this->hasMany(PackageMessage::class, 'book_package_id');
    }
    public function offer()
    {
        return $this->hasOne(PackageMakeOffer::class, 'booking_id');
    }
}
