<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentMessage extends Model
{
    protected $fillable = ['appointment_conversation_id', 'user_id', 'message', 'voice', 'file'];

    protected $appends = ['voice_url'];

    public function getVoiceUrlAttribute()
    {
        if ($this->voice) {
            return asset('storage/' . $this->voice);
        }
        return '';
    }

    protected $touches = ['conversation'];

    public function conversation()
    {
        return $this->belongsTo(AppointmentConversation::class, 'appointment_conversation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
