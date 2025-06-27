<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    public $fillable = ['question', 'answer'];
    public $casts=[
        'question'=>'array',
        'answer'=>'array'
    ];

    public function getTranslatedTitle($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->question[$lang]??"";
    }

    public function getTranslatedDescription($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->answer[$lang]??"";
    }
    public function scopeActive($query){
        return $query->where('status',1);
    }

}
