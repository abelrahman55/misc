<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeleconsultationMedicalFile extends Model
{
    protected $fillable = [
        'teleconsultation_request_id',
        'file_path',
    ];

    public function request()
    {
        return $this->belongsTo(TeleconsultationRequest::class, 'teleconsultation_request_id');
    }
}
