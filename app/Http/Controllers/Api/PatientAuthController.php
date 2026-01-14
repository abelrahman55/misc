<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CheckCode;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\SendCodeRequest;
use App\Http\Requests\Api\UserLogin;
use App\Http\Requests\Api\UserRegistRequest;
use App\Services\Api\PatientAuthService;
use App\Services\Api\PatientResetPasswordService;

class PatientAuthController{
    public function user_regist(UserRegistRequest $request){
        $regist=PatientAuthService::PatientRegist($request->validated());
        return $regist;
    }
    public function check_code(CheckCode $request){
        $check=PatientAuthService::CheckCode($request->validated());
        return $check;
    }
    // public function user_login(UserLogin $request){
    //     $login=PatientAuthService::UserLogin($request->validated());
    //     return $login;
    // }
    public function user_login(UserLogin $request)
{
    $data = $request->validated();
    if(isset($data['provider']) && isset($data['provider_id'])){
        return $this->social_login($data);
    } else {
        return $this->normal_login($data);
    }
}


protected function normal_login($data)
{
    $credentials = request(['email', 'password']);
    $lang = request()->header('lang','ar');

    if (! $token = auth()->guard('users')->attempt($credentials)) {
        return response()->json([
            'message' => $lang=='ar'?'البريد الالكترونى او كلمة السر خاطئه':'Email or password is incorrect',
            'result' => new \stdClass(),
            'status' => 'failed'
        ],401);
    }

    $user = auth()->guard('users')->user();

    if($user->active==0){
        return response()->json([
            'message'=>$lang=='ar'?'الحساب غير مفعل':'Account is not active',
            'result'=>new \stdClass(),
            'status'=>'failed'
        ],409);
    }

    if($user->ban==1){
        return response()->json([
            'message'=>$lang=='ar'?'الحساب محظور':'Account is banned',
            'result'=>new \stdClass(),
            'status'=>'failed'
        ],410);
    }

    $result = [
        'token' => $token,
        'id' => $user->id*1,
        'role' => $user->role,
    ];

    return response()->json([
        'message' => $lang=='ar'?'تم تسجيل الدخول بنجاح':'Login successfully',
        'result' => $result,
        'status' => 'success'
    ],200);
}

protected function social_login($data)
{
    $lang = request()->header('lang','ar');

    $user = \App\Models\User::firstOrCreate(
        [
            'provider' => $data['provider'],
            'provider_id' => $data['provider_id'],
            'type' => $data['type'],
            'role' => $data['role'],
        ],
        [
            'name' => $data['name'] ?? 'User',
            'email' => $data['email'] ?? null,
            'password' => bcrypt(uniqid()),
            'type' => $data['type'],
            'role' => $data['role'],
        ]
    );

    // توليد Token
    $token = auth()->guard('users')->login($user);

    $result = [
        'token' => $token,
        'id' => $user->id*1,
        'role' => $user->role,
        'provider' => $user->provider,
    ];

    return response()->json([
        'message' => $lang=='ar'?'تم تسجيل الدخول بنجاح':'Login successfully',
        'result' => $result,
        'status' => 'success'
    ],200);
}



    public function send_code(SendCodeRequest $request){
        $send=PatientResetPasswordService::SendCode($request->validated());
        return $send;
    }
    public function reset_password(ResetPasswordRequest $request){
        $reset=PatientResetPasswordService::ResetPassword($request->validated());
        return $reset;
    }
    public function check_data_completed(){
        $user = auth()->guard('users')->user();
        if(!$user){
            return 1;
        }
        return $user->is_comp;

    }
}
