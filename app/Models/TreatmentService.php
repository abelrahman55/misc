<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentService extends Model
{
    //
    public $fillable = ['title','status'];
    public $casts=[
        'title'=>'array',
    ];

    public function getTranslatedTitle($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->title[$lang]??"";
    }


    public function scopeActive($query){
        return $query->where('status',1);
    }

}
