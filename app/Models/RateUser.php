<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateUser extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function provider(){
        return $this->belongsTo(User::class,'provider_id');
    }
    public $fillable=[
        'user_id',
        'provider_id',
        'rate',
        'comment',
        'status',
    ];

    public $casts=[
        'status'=>'integer',
        'rate'=>'integer',
        'user_id'=>'integer',
        'provider_id'=>'integer',
    ];
    //
}