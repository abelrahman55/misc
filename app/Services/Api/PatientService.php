<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Auth;

class PatientService{

    static function GetPatientData(){
        $data = Auth::guard('users')->user();
        $data=[
            'id'=>$data->id,
            'full_name'=>$data->full_name,
            'prof_img'=>$data->prof_img_url,
            'email'=>$data->email,
            'phone'=>$data->phone,
        ];
        return res_data($data,'',200);
        // return $data;
    }
}
