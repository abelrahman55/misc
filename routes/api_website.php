<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ArticlesController;

use App\Http\Controllers\Api\FeedBackController;
use App\Http\Controllers\Api\SpecialtiesController;
use App\Http\Controllers\Web\SpecialtiesDashController;
use App\Http\Controllers\Web\FaqsController as WebFaqsController;
use App\Http\Controllers\Web\BlogController as WebBlogController;;

use App\Http\Controllers\Web\BrandController as WebBrandController;
use App\Http\Controllers\Web\AboutUsController as WebAboutUsController;
use App\Http\Controllers\Web\ServiceController as WebServiceController;
use App\Http\Controllers\Web\ArticlesController as WebArticlesController;


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
    'prefix'=>'blogs',
],function(){
    Route::get('blogs',[WebBlogController::class,'index'])->name('blogs.index');
    Route::post('blogs',[WebBlogController::class,'store'])->name('blogs.store');
    Route::post('blogs/{id}',[WebBlogController::class,'update'])->name('blogs.update');
    Route::delete('blogs',[WebBlogController::class,'delete'])->name('blogs.delete');
    Route::get('get_blogs',[BlogController::class,'index']);
});

Route::group([
    'prefix'=>'articles',
],function(){
    Route::get('articles',[WebArticlesController::class,'index'])->name('articles.index');
    Route::post('articles',[WebArticlesController::class,'store'])->name('articles.store');
    Route::post('articles/{id}',[WebArticlesController::class,'update'])->name('articles.update');
    Route::delete('articles',[WebArticlesController::class,'delete'])->name('articles.delete');
    Route::get('get_articles',[ArticlesController::class,'index']);
});

Route::group([
    'prefix'=>'aboutus',
],function(){
    Route::get('aboutus',[WebAboutUsController::class,'index'])->name('aboutus.index');
    Route::post('aboutus',[WebAboutUsController::class,'store'])->name('aboutus.store');
    Route::get('get_AboutUs',[AboutUsController::class,'index']);
});

Route::group([
    'prefix'=>'brand',
],function(){
    Route::get('brand',[WebBrandController::class,'index'])->name('brand.index');
    Route::post('brand',[WebBrandController::class,'store'])->name('brand.store');
    Route::get('get_Brand',[BrandController::class,'index']);
});

Route::group([
    'prefix'=>'services',
],function(){
    Route::get('services',[WebServiceController::class,'index'])->name('services.index');
    Route::post('services',[WebServiceController::class,'store'])->name('services.store');
    Route::post('services/{id}',[WebServiceController::class,'update'])->name('services.update');
    Route::delete('services',[WebServiceController::class,'delete'])->name('services.delete');
    Route::get('get_Services',[ServiceController::class,'index']);
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
