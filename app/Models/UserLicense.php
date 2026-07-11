<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLicense extends Model
{
    //
    public $table = 'user_licenses';
    public $fillable = [
        'user_id',
        'file',
        'type',
    ];
}
