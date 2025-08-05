<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    //
    protected $table = 'user_notes';
    public $fillable=[
        'note',
        'user_id'
    ];
}