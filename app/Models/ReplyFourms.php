<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyFourms extends Model
{
    public $fillable=[
        'forum_id',
        'user_id',
        'reply',
    ];

    public function forum()
    {
        return $this->belongsTo(Forums::class,'forum_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
