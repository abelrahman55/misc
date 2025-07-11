<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    //
    public $table='countries';
    public $fillable=['name'];
    public $casts=[
        'name'=>'array'
    ];
    // public $appends=['name'];
    // public function getNameAttribute(){
    //     $lang=request()->header('lang','ar');
    //     return $this->name[$lang]??"";
    // }
    public function some_providers(){
        return $this->hasMany(User::class,'country_id')->where('active',1)->where('ban',0)->where('ban',0)->where('role','doctor')->where('role','doctor')->take(10)->select('id','f_name','country_id','prof_img');
    }
}
