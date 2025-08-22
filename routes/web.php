<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\PatientDashController;
use App\Http\Controllers\Web\DashboardPatient\HomeController;
use App\Http\Controllers\Web\DashboardPatient\InquiryController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('patients',[PatientDashController::class,'patients'])->name('patients');
Route::get('change_active/{id}',[PatientDashController::class,'change_active'])->name('change_active');
Route::get('patient_profile/{id}',[PatientDashController::class,'patient_profile'])->name('patient_profile');

Route::group([
    'prefix'     => 'patient',
    'as'         => 'patient.',
    // 'namespace'  => 'DashboardPatient',
    // 'middleware' => ['auth','role:patient']
], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('inquiries', InquiryController::class);
});
