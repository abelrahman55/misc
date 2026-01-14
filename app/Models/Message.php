<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'conversation_id',
        'user_id',
        'message',
        'read',
        'voice',
        'file',
    ];

    public $appends = ['voice_url'];

    public function getVoiceUrlAttribute()
    {
        if ($this->voice) {
            return asset('storage/' . $this->voice);
        }
        return '';
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
