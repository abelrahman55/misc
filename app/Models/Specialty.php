<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    //
    protected $table = 'specialties';

    protected $fillable = [
        'title',
        'status',
    ];
    public function scopeActive($query){
        return $query->where('status',1);
    }
    public $casts = [
        'title' => 'array',
    ];
}
