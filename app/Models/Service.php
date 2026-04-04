<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $fillable = ['title', 'description', 'image', 'status'];
    public $casts=[
        'title'=>'array',
        'description'=>'array'
    ];

     public function getTranslatedTitle($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->title[$lang]??"";
    }
    public function getTranslatedDescription($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->description[$lang]??"";
    }

    
     public function scopeActive($query){
        return $query->where('status',1);
    }
}
