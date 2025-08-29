<?php

use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Api\ProvidersController;
use App\Http\Controllers\Web\PatientDashController;
use App\Http\Controllers\Web\RolesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\DashboardPatient\HomeController;
use App\Http\Controllers\Web\DashboardPatient\InquiryController;
use App\Http\Controllers\Web\DashboardPatient\DocumentCenterController;
use App\Http\Controllers\Web\DashboardPatient\FeedbackReviewController;

Route::get('/', function () {
    // return 'rere';
    return view('welcome');
})->middleware('admin');


Route::get('patients',[PatientDashController::class,'patients'])->name('patients');
Route::get('change_active/{id}',[PatientDashController::class,'change_active'])->name('change_active');
Route::get('patient_profile/{id}',[PatientDashController::class,'patient_profile'])->name('patient_profile');

Route::get('welcome_provider',[ProvidersController::class,'welcome_provider'])->name('welcome_provider');


Route::get('/admin_login',[AdminsController::class,'admin_login'])->name('admin_login');
Route::post('admin_regist',[AdminsController::class,'admin_regist'])->name('admin_regist');
Route::get('admin_logout',[AdminsController::class,'admin_logout'])->name('admin_logout');

Route::resource('roles', RolesController::class);
Route::get('provider_profile',[ProvidersController::class,'provider_profile'])->name('provider_profile')->middleware('admin');

Route::post('upload_file',[ProvidersController::class,'upload_file'])->name('upload_file');
Route::post('add_note',[ProvidersController::class,'add_note'])->name('add_note');
Route::get('provider_patient',[ProvidersController::class,'provider_patient'])->name('provider_patient');
Route::get('provider_ratings',[ProvidersController::class,'provider_ratings'])->name('provider_ratings');