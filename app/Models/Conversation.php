<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'receiver_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'receiver_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
    public function sender(){
        return $this->belongsTo(User::class,'user_id');
    }

    // protected static function newFactory(): ConversationFactory
    // {
    //     // return ConversationFactory::new();
    // }
}