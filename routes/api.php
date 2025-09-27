<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProxmimityController;
use App\Http\Controllers\TreatmentServicesController;
use App\Http\Controllers\Web\CountriesController;
use App\Http\Controllers\Web\PackageOptionsController;
use App\Http\Controllers\Web\PackagesController;
use App\Http\Controllers\Web\ServicesWebController;
use App\Http\Controllers\Web\WhatWeWorkWebController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group()

Route::post('store_new_country',[CountriesController::class,'store_new_country']);

Route::post('store_new_work',[WhatWeWorkWebController::class,'store_new_work']);
Route::post('store_new_service',[ServicesWebController::class,'store_new_service']);
Route::post('add_new_treatment_service',[TreatmentServicesController::class,'add_new_treatment_service']);
Route::get('assign_role',[PatientController::class,'assign_role']);

Route::post('add_new_prox',[ProxmimityController::class,'add_new_prox']);
Route::post('add_new_option',[PackageOptionsController::class,'add_new_option']);
Route::post('add_new_package',[PackagesController::class,'add_new_package']);
Route::post('assign_options_topackages',[PackageOptionsController::class,'assign_options_topackages']);