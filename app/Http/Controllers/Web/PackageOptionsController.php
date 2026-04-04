<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageOption;
use App\Models\RelatedPackageOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageOptionsController extends Controller
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
        $new=PackageOption::create($data);
        return redirect()->back()->with('success','Success To Add');
    }
    public function assign_options_topackages(Request $request){
        $validator=Validator::make($request->all(),[
            'options'=>'required|array',
            'package_id'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=$validator->validated();
        foreach($data['options']??[] as $opt){
            $ass_new=RelatedPackageOption::create([
                'package_id'=>$request->package_id??0,
                'package_option_id'=>$opt
            ]);
        }
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
    }
}