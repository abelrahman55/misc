<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageNursingOption;
use App\Models\RelatedPackageNursingOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageOptionsNursingController extends Controller
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
        $new=PackageNursingOption::create($data);
        return redirect()->back()->with('success','Success To Add');
    }
    public function assign_options_topackages(Request $request){
        $validator=Validator::make($request->all(),[
            'options'=>'required|array',
            'package_nursing_id'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=$validator->validated();
        foreach($data['options']??[] as $opt){
            $ass_new=RelatedPackageNursingOption::create([
                'package_nursing_id'=>$request->package_nursing_id??0,
                'package_nursing_option_id'=>$opt
            ]);
        }
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
    }
}
