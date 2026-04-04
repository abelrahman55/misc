<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRatio extends Model
{
    //
    protected $table = "medical_ratios";
    protected $fillable = [
        "heart_rate",
        "blood_pressure",
        "temperature",
        "respiratory_rate",
        "oxygen_saturation",
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
