<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $table = 'teams';
    protected $fillable = ['name', 'image', 'position', 'status', 'description'];
    protected $casts = [
        'description' => 'array',
    ];
    public $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
