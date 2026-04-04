<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLicense extends Model
{
    public $table = 'user_licenses';
    public $fillable = [
        'user_id',
        'file',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrlAttribute()
    {
        if ($this->file) {
            return asset('storage/' . $this->file);
        }
        return null;
    }
}
