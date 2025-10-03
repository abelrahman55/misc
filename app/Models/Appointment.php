<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    public $fillable=[
        'commun_method',
        'country_id',
        'treatment_service_id',
        'appoint_date',
        'appoint_time',
        'urgence_level',
        'doctor_id',
        'client_id',
        'status',
    ];
    public function client(){
        return $this->belongsTo(User::class,'client_id');
    }
    public function doctor(){
        return $this->belongsTo(User::class,'doctor_id');
    }
    public function treatmentservice(){
        return $this->belongsTo(TreatmentService::class,'treatment_service_id');
    }
    public function country(){
        return $this->belongsTo(Countries::class,'country_id');
    }
}
