<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\Specialty\AddNewRquest;
use App\Models\Specialty;

class SpecialtiesDashController{
    public function store_new_specialty(AddNewRquest $request){
        $new=Specialty::create($request->validated());
        if($new){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }
}
