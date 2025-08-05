<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountriesController extends Controller
{
    //
    public function store_new_country(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['status'=>false,'message'=>$validator->errors()->first()]);
        }
        $data=$validator->validated();
        $country=Countries::create($data);

        return response()->json(['status'=>true,'message'=>'Country Added Successfully']);
    }
}