<?php

namespace App\Services\Api;

use App\Models\DoctorFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompeleteProviderService{
    static function CompeleteProvider($data){
        // return $data;
        $doctor=Auth::guard('users')->user();
        $doc_data=[
            'specialization_id'=>$data['specialty_id']??null,
            // 'provider_id'=>$data['provider_id'],
            'complaints'=>$data['complaint']??null,
            // 'doctor_id'=>$doctor->id,
            'doctor_date'=>$data['doctor_date']??null,
            'doctor_time'=>$data['doctor_time']??null,
        ];
        $up=User::where('id',$doctor->id)->update($doc_data);
        if(request()->hasFile('doctor_files')) {
            foreach (request()->file('doctor_files') as $file) {
                $up_file = CompeleteProviderService::UploadFile($file);
                $doc_file['user_id'] = $doctor->id;
                $doc_file['file'] = $up_file;
                $new_file=DoctorFile::create($doc_file);
                // $up=User::where('id',$doctor->id)->update($doc_data);
            }
        }
        if($up){
            return res_data('','تم التحديث بنجاح',200);
        }
        return res_data('','حدث خطاء',400);
    }
    static function UploadFile($file){
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('files'), $file_name);
        return $file_name;
    }
}
