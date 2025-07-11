<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateSystem extends Model
{
    //
    public $table='rate_stystems';
    public $fillable=[
        'user_id',
        'rate',
        'comment',
        'status'
    ];
    public $casts=[
        'user_id'=>'integer',
        'rate'=>'integer',
        'status'=>'integer'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
