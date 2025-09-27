<?php

namespace App\Http\Controllers;

use App\Models\Proxmimity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProxmimityController extends Controller
{
    //
    public function add_new_prox(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
        ]);
        $data=$validator->validated();
        $new=Proxmimity::make($data);
        return redirect()->back()->with('success','تمت الاضافه بنجاح');
    }
}