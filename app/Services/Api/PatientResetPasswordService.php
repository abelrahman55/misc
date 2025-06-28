<?php

namespace App\Services\Api;

use App\Models\User;

class PatientResetPasswordService{
    static function SendCode($data){
        $code=rand(10000,99999);
        $data['code']=$code;
        $user=User::where('email',$data['email'])->first();
        if($user){
            $user->code=$code;
            $user->save();
            return res_data($code,'Patient regist successfully',200);
        }
        return res_data($code,'Patient regist failed',400);
    }
    static function ResetPassword($data){
        $user=User::where('email',$data['email'])->where('code',$data['code'])->first();
        if($user){
            $user->password=bcrypt($data['password']);
            $user->code=null;
            $user->save();
            return res_data('','Patmessage: ient regist successfully',200);
        }
        return res_data('','Patmessage: ient regist failed',400);
    }
}
