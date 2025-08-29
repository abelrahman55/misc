<?php

use App\Http\Controllers\Api\CompeleteProviderController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\PatientAuthController;
use App\Http\Controllers\Api\PatientDataController;
use App\Http\Controllers\Web\FaqsController as WebFaqsController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix'=>'auth',
],function(){
    Route::post('user_regist',[PatientAuthController::class,'user_regist']);
    Route::post('check_code',[PatientAuthController::class,'check_code']);
    Route::post('user_login',[PatientAuthController::class,'user_login']);
    Route::post('reset_password',[PatientAuthController::class,'reset_password']);

    Route::group([

    ],function(){
        Route::post('complete_data',[PatientDataController::class,'complete_data']);
        Route::post('compelete_provider',[CompeleteProviderController::class,'compelete_provider']);

    });

});
