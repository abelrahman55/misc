<?php

namespace App\Http\Controllers\Api;


use App\Models\PackageHospital;
use App\Http\Controllers\Controller;
use App\Models\PackageHospitalOption;

class PackagesHospitalController extends Controller
{
    //
    public function book_packages(){
        $lang=request()->header('lang','ar');
        $packages=PackageHospital::with('optionsHospital')->get()
        ->map(function($item)use($lang){
            return [
                'id'=>$item->id,
                'price'=>$item->price??0,
                'title' => $item?->title[$lang] ?? "",
                'options'=>$item?->optionsHospital->map(function($it)use($lang){
                    return [
                        'id'=>$it->id??0,
                        'title'=>$it?->title[$lang]??""
                    ];
                })
            ];
        })
        ;
        return res_data($packages,'',200);
    }
    public function other_options(){
        $lang=request()->header('lang','ar');
        $pack_id=request('id');
        $options=PackageHospitalOption::whereDoesntHave('pacakesHospital',function($q)use($pack_id){
            $q->where('package_hospital_id',$pack_id);
        })->get()
                ->map(function($item)use($lang){
            return [
                'id'=>$item->id,
                'title' => $item?->title[$lang] ?? "",
            ];
        })
        ;
        return res_data($options,'',200);
    }
}
