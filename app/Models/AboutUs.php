<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public $fillable = ['title', 'description', 'image'];
    public $casts = [
        'title' => 'array',
        'description' => 'array'
    ];

    public function getTranslatedTitle($local = 'ar')
    {
        $lang = request()->header('lang', 'ar');
        return $this->title[$lang] ?? "";
    }

    public function getTranslatedDescription($local = 'ar')
    {
        $lang = request()->header('lang', 'ar');
        return $this->description[$lang] ?? "";
    }
}
