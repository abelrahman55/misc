<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proxmimity extends Model
{
    //
    public $fillable = ['name'];
    public $casts=[
        'name'=>'array',
    ];

    public function getTranslatedName($local='ar'){
        $lang=request()->header('lang','ar');
        return $this->name[$lang]??"";
    }
}
