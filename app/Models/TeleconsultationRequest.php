<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TeleconsultationRequest extends Model
{
    protected $fillable = [
        'client_id',
        'specialty_id',
        'admin_id',
        'doctor_id',
        'complaint',
        'appointment_date',
        'price',
        'offer_details',
        'status',
        'rejection_reason',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function messages()
    {
        return $this->hasMany(TeleconsultationMessage::class, 'teleconsultation_request_id')->orderBy('created_at', 'asc');
    }

    public function medicalFiles()
    {
        return $this->hasMany(TeleconsultationMedicalFile::class, 'teleconsultation_request_id');
    }

    // Keep alias for compatibility if needed, but 'medicalFiles' is preferred now.
    public function files()
    {
        return $this->medicalFiles();
    }

    public function latestMessage()
    {
        return $this->hasOne(TeleconsultationMessage::class, 'teleconsultation_request_id')->latestOfMany();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
