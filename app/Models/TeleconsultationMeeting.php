<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleconsultationMeeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'teleconsultation_request_id',
        'doctor_id',
        'client_id',
        'date',
        'time',
        'meeting_url',
        'ended'
    ];

    public function request()
    {
        return $this->belongsTo(TeleconsultationRequest::class, 'teleconsultation_request_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
