<?php

namespace App\Services\Api;

use App\Models\User;
use App\Models\UserSergical;
use App\Models\UserSergicalType;
use App\Models\UserSergicalTypeTranslation;
use App\Models\UserSurgery;
use App\Models\UserSurgeryTranslation;
use Illuminate\Support\Facades\Auth;
use stdClass;

class PatientAuthService
{
    static function PatientRegist($data){
        $code=rand(10000,99999);
        $data['code']=$code;
        $data['password']=bcrypt($data['password']);
        $new=User::create($data);
        // $new->assignRole('patient');
        if($new){
            return res_data($code,'Patient regist successfully',200);
        }
        return res_data($code,'Patient regist failed',400);
    }
    static function CheckCode($data){
        $user=User::where('email',$data['email'])->where('code',$data['code'])->first();
        if($user){
            $user->code=null;
            $user->active=1;
            $user->save();
            return res_data('','Patmessage: ient regist successfully',200);
        }
        return res_data('','Patmessage: ient regist failed',400);
    }
    static function UserLogin($data){
                $credentials = request(['email', 'password']);
        $lang=request()->header('lang','ar');
        if (! $token = auth()->guard('users')->attempt($credentials)) {
            // return 'erre';
            return response()->json([
                'message'=>$lang=='ar'?'البريد الالكترونى او كلمة السر خاطئه':'Email or password is incorrect',
                'result'=>new stdClass(),
                'status'=>'failed'
            ],401);
        }
        $user=Auth::guard('users')->user();
        if($user->active==0){
            return response()->json([
                'message'=>$lang=='ar'?'الحساب غير مفعل':'Account is not active',
                'result'=>new stdClass(),
                'status'=>'faild'
            ],409);
        }
        if($user->ban==1){
            return response()->json([
                'message'=>$lang=='ar'?'الحساب محظور':'Account is banned',
                'result'=>new stdClass(),
                'status'=>'faild'
            ],410);
        }
        $data=[
                'token'=>$token,
                'id'=>$user->id*1,
                'role'=>$user->role,
            ];
        return response()->json([
            'message'=>$lang=='ar'?'تم تسجيل الدخول بنجاح':'Login successfully',
            'result'=>$data,
            'status'=>'success'
        ],200);
    }
}