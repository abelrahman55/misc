<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackagesController extends Controller
{
    //
    public function add_new_package(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required',
            'price'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data=$validator->validated();
        $new=Package::create($data);
        return redirect()->back()->with('success','Success To Add');
    }
}
