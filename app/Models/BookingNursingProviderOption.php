<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingNursingProviderOption extends Model
{
    public $fillable=[
        'booking_id',
        'package_option_id',
    ];
    public $casts=[
        'booking_id'=>'int',
        'package_option_id'=>'int'
    ];
    public function packageoption(){
        return $this->belongsTo(PackageNursingOption::class,'package_option_id');
    }
    public function booking(){
        return $this->belongsTo(BookingNursingProvider::class,'booking_id');
    }
}
