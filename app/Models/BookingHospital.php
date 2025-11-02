<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingHospital extends Model
{
    public $table='booking_hospitals';
    public $fillable=[
        'package_id',
        'provider_id',
        'user_id',
        'date',
    ];
    public $casts=[
        'package_id'=>'int',
        'provider_id'=>'int',
        'user_id'=>'int',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function provider(){
        return $this->belongsTo(User::class,'provider_id');
    }
    public function package(){
        return $this->belongsTo(PackageHospital::class,'package_id');
    }
    public function options(){
        return $this->hasMany(BookingHospitalOption::class,'booking_id');
    }
}
