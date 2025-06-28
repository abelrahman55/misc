<?php

use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\FeedBackController;
use App\Http\Controllers\Api\SpecialtiesController;
use App\Http\Controllers\Web\FaqsController as WebFaqsController;
use App\Http\Controllers\Web\SpecialtiesDashController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'prefix'=>'faqs',
],function(){
    Route::post('store_new_faqs',[WebFaqsController::class,'store_new_faqs']);
    Route::get('get_faqs',[FaqsController::class,'get_faqs']);
});

Route::group([
    'prefix'=>'specialties',
],function(){
    Route::get('get_specialties',[SpecialtiesController::class,'get_specialties']);
    Route::post('store_new_specialties',[SpecialtiesDashController::class,'store_new_specialty']);
});


Route::group([
    'prefix'=>'feedback',
],function(){
    Route::post('add_feedback',[FeedBackController::class,'add_feedback']);
});