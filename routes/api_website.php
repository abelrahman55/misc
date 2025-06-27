<?php

use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Web\FaqsController as WebFaqsController;
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
