<?php

use App\Http\Controllers\Web\CountriesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::group()

Route::post('store_new_country',[CountriesController::class,'store_new_country']);