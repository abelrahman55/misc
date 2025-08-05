<?php

use App\Http\Controllers\Web\PatientDashController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('patients',[PatientDashController::class,'patients'])->name('patients');
Route::get('change_active/{id}',[PatientDashController::class,'change_active'])->name('change_active');
Route::get('patient_profile/{id}',[PatientDashController::class,'patient_profile'])->name('patient_profile');
