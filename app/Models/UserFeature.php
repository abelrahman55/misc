<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFeature extends Model
{
    //
    public function user(){
        return $this->belongsTo(User::class);
    }
    public $fillable=['user_id','title'];
}
