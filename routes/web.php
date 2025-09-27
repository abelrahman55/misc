<?php

use App\Http\Controllers\Api\ConversationsController;
use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Api\ProvidersController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentServicesController;
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



 Route::post('/document_centers', [DocumentCenterController::class, 'store'])->name('document_centers.store');


    Route::delete('/document_centers/{id}', [DocumentCenterController::class, 'destroy'])->name('document_centers.destroy');


    Route::get('document_centers',[DocumentCenterController::class,'index'])->name('document_centers');



     Route::get('/feedback_review', [FeedbackReviewController::class, 'index'])->name('feedback_review');


    Route::post('/feedback_review', [FeedbackReviewController::class, 'store'])->name('feedback_review.store');




    Route::resource('inquiries', InquiryController::class);

    Route::get('patient_schedules',[TreatmentServicesController::class,'patient_schedules'])->name('patient_schedules');
    Route::get('messages',[ConversationsController::class,'messages'])->name('messages');
    Route::post('reply_review/{id}',[ProvidersController::class,'reply_review'])->name('reply_review');
    Route::get('provider_schedules',[TreatmentServicesController::class,'provider_schedules'])->name('provider_schedules');
    Route::get('admin_patients',[PatientController::class,'admin_patients'])->name('admin_patients');
Route::get('log_out',[PatientController::class,'log_out'])->name('log_out');
