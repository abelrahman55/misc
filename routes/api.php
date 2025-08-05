<?php

use App\Http\Controllers\Web\CountriesController;
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