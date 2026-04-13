<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleconsultationMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'teleconsultation_request_id',
        'user_id',
        'user_type',
        'message',
        'file',
    ];

    public function request()
    {
        return $this->belongsTo(TeleconsultationRequest::class, 'teleconsultation_request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
