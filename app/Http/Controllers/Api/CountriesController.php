<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    //
    public function get_countries(){
        $lang=request()->header('lang','ar');
        $countries=Countries::get(['id','name'])->map(function($country)use($lang){
            return[
                'id'=>$country->id,
                'name'=>$country->name[$lang]??"",
            ];
        });
        return res_data($countries,'',200);
    }
    public function countries_with_providers(){
        $lang=request()->header('lang','ar');
        $countries=Countries::with('some_providers')->get(['id','name'])->map(function($country)use($lang){
            return[
                'id'=>$country->id,
                'name'=>$country->name[$lang]??"",
                'providers'=>$country->some_providers,
            ];
        });
        return res_data($countries,'',200);
    }
}
