<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatWeWork extends Model
{
    //
    protected $table = 'what_we_works';
    protected $fillable = ['title', 'image', 'status', 'priority'];
    protected $casts = [
        'title' => 'array',
    ];
    public $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
