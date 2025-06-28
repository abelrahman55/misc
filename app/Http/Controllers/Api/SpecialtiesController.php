<?php

namespace App\Http\Controllers\Api;

use App\Models\Specialty;

class SpecialtiesController{
    public function get_specialties(){
        $lang=request()->header('lang','ar');
        $specialties=Specialty::get()->map(function($specialty)use($lang){
            return [
                'id'=>$specialty->id??0,
                'title'=>$specialty->title[$lang]??"",
            ];
        });
        return res_data($specialties,'',200);
    }
}
