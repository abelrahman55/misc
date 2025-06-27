<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CheckCode;
use App\Http\Requests\Api\UserLogin;
use App\Http\Requests\Api\UserRegistRequest;
use App\Services\Api\PatientAuthService;

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
}