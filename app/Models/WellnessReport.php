<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WellnessReport extends Model
{
    //
    protected $table = 'wellness_reports';
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