<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RelatedPackageOption;
use App\Models\PackageHospitalOption;
use Illuminate\Support\Facades\Validator;
use App\Models\RelatedPackageHospitalOption;

class PackageOptionsHospitalController extends Controller
{
    //
    public function add_new_option(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=$validator->validated();
        $new=PackageHospitalOption::create($data);
        return redirect()->back()->with('success','Success To Add');
    }
    public function assign_options_topackages(Request $request){
        $validator=Validator::make($request->all(),[
            'options'=>'required|array',
            'package_hospital_id'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=$validator->validated();
        foreach($data['options']??[] as $opt){
            $ass_new=RelatedPackageHospitalOption::create([
                'package_hospital_id'=>$request->package_hospital_id??0,
                'package_hospital_option_id'=>$opt
            ]);
        }
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
    }
}
