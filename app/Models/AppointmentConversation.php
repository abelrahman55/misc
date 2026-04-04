<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentConversation extends Model
{
    protected $fillable = ['user_id', 'receiver_id', 'appointment_id'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages()
    {
        return $this->hasMany(AppointmentMessage::class, 'appointment_conversation_id');
    }
}
