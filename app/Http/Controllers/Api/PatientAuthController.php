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
    public function user_login(UserLogin $request){
        $login=PatientAuthService::UserLogin($request->validated());
        return $login;
    }
    public function send_code(SendCodeRequest $request){
        $send=PatientResetPasswordService::SendCode($request->validated());
        return $send;
    }
    public function reset_password(ResetPasswordRequest $request){
        $reset=PatientResetPasswordService::ResetPassword($request->validated());
        return $reset;
    }
}
