<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

     public $fillable = ['title', 'description', 'image', 'status'];
    public $casts=[
        'title'=>'array',
        'description'=>'array'
    ];

     public function scopeActive($query){
        return $query->where('status',1);
    }
}
