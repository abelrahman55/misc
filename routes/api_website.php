<?php

use Illuminate\Support\Facades\Route;
use App\Services\Api\RateSystemService;
use App\Http\Controllers\ForumsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\FaqsController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\LikeForumsController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\ReplyForumsController;
use App\Http\Controllers\Api\ArticlesController;
use App\Http\Controllers\Api\FeedBackController;
use App\Http\Controllers\Api\RateUserController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\ProvidersController;
use App\Http\Controllers\Api\RateSystemController;
use App\Http\Controllers\Api\SpecialistsController;
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
    Route::get('our_specialist',[SpecialistsController::class,'our_specialist']);
    Route::get('get_specialties',[SpecialtiesController::class,'get_specialties']);
    Route::post('store_new_specialties',[SpecialtiesDashController::class,'store_new_specialty']);
    Route::get('specialty_providers/{id}',[SpecialtiesController::class,'specialty_providers']);
});


Route::group([
    'prefix'=>'feedback',
],function(){
    Route::post('add_feedback',[FeedBackController::class,'add_feedback']);
});


Route::group([
    'prefix'=>'countries',
],function(){
    Route::get('get_countries',[CountriesController::class,'get_countries']);
    Route::get('countries_with_providers',[CountriesController::class,'countries_with_providers']);
});

Route::group([
    'prefix'=>'rates',
    'middleware'=>'user_login',
],function(){
    Route::post('make_rate',[RateUserController::class,'make_rate']);
    Route::post('rate_system',[RateSystemController::class,'rate_system']);
    Route::get('clients_rates',[RateSystemController::class,'clients_rates']);
});


Route::group([
    'prefix'=>'patient',
    'middleware'=>'user_login',
],function(){
    Route::get('patient_data',[PatientController::class,'patient_data']);
});
Route::group([
    'prefix'=>'providers',
],function(){
    Route::get('best_providers',[ProvidersController::class,'best_providers']);
});

Route::group([
    'prefix'=>'forums',
    'middleware'=>'user_login',
],function(){
    Route::post('make_forum',[ForumsController::class,'make_forum']);
});


Route::group([
    'prefix'=>'forums',
],function(){
    Route::get('forum_data',[ForumsController::class,'forum_data']);
});

Route::group([
    'prefix'=>'reply_forums',
    'middleware'=>'user_login',
],function(){
    Route::post('make_reply_forum/{id}',[ReplyForumsController::class,'make_reply_forum']);
});


Route::group([
    'prefix'=>'reply_forums',
],function(){
    Route::get('reply_forum_data/{id}',[ReplyForumsController::class,'reply_forum_data']);
});

Route::group([
    'prefix'=>'like_forums',
    'middleware'=>'user_login',
],function(){
    Route::post('make_like_forum/{id}',[LikeForumsController::class,'make_like_forum']);
});


Route::group([
    'prefix'=>'like_forums',
],function(){
    Route::get('like_forum_data/{id}',[LikeForumsController::class,'like_forum_data']);
});

