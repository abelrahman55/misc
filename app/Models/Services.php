<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //
    protected $table = 'services';
    protected $fillable = ['title', 'image', 'status', 'description'];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];
    public $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
