<?php

use App\Http\Controllers\Api\ConversationsController;
use App\Http\Controllers\Api\ProvidersController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TreatmentServicesController;
use App\Http\Controllers\Web\AdminsController;
use App\Http\Controllers\Web\AdminWelcomeController;
use App\Http\Controllers\Web\ChatController;
use App\Http\Controllers\Web\CouponsController;
use App\Http\Controllers\Web\DashboardPatient\DocumentCenterController;
use App\Http\Controllers\Web\DashboardPatient\FeedbackReviewController;
use App\Http\Controllers\Web\DashboardPatient\InquiryController;
use App\Http\Controllers\Web\MyBookingsController;
use App\Http\Controllers\Web\PackageController;
use App\Http\Controllers\Web\PackageHospitalController;
use App\Http\Controllers\Web\PackageNursingController;
use App\Http\Controllers\Web\PackageOptionController;
use App\Http\Controllers\Web\PackageOptionHospitalController;
use App\Http\Controllers\Web\PackageOptionNursingController;
use App\Http\Controllers\Web\PatientDashController;
use App\Http\Controllers\Web\RolesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminWelcomeController::class, 'welcome'])->middleware('admin');

Route::get('patients', [PatientDashController::class, 'patients'])->name('patients');
Route::get('change_active/{id}', [PatientDashController::class, 'change_active'])->name('change_active');
Route::get('patient_profile/{id}', [PatientDashController::class, 'patient_profile'])->name('patient_profile');
Route::post('patient_profile/update', [PatientDashController::class, 'update_profile'])->name('update_profile');

Route::get('welcome_provider', [ProvidersController::class, 'welcome_provider'])->name('welcome_provider');

Route::get('/admin_login', [AdminsController::class, 'admin_login'])->name('admin_login');
Route::post('admin_regist', [AdminsController::class, 'admin_regist'])->name('admin_regist');
Route::get('admin_logout', [AdminsController::class, 'admin_logout'])->name('admin_logout');

Route::resource('roles', RolesController::class);
Route::get('provider_profile', [ProvidersController::class, 'provider_profile'])->name('provider_profile')->middleware('admin');

Route::post('upload_file', [ProvidersController::class, 'upload_file'])->name('upload_file');
Route::post('add_note', [ProvidersController::class, 'add_note'])->name('add_note');
Route::get('provider_patient', [ProvidersController::class, 'provider_patient'])->name('provider_patient');
Route::get('provider_ratings', [ProvidersController::class, 'provider_ratings'])->name('provider_ratings');

Route::post('/document_centers', [DocumentCenterController::class, 'store'])->name('document_centers.store');

Route::delete('/document_centers/{id}', [DocumentCenterController::class, 'destroy'])->name('document_centers.destroy');

Route::get('document_centers', [DocumentCenterController::class, 'index'])->name('document_centers');

Route::get('/feedback_review', [FeedbackReviewController::class, 'index'])->name('feedback_review');

Route::post('/feedback_review', [FeedbackReviewController::class, 'store'])->name('feedback_review.store');

// Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

Route::resource('inquiries', InquiryController::class);
Route::resource('packages', PackageController::class);
Route::get('packages_reservations/{id}', [PackageController::class, 'packages_reservations'])->name('packages_reservations');
Route::resource('packages_nursing', PackageNursingController::class);
Route::get('packages_nursing_reservations/{id}', [PackageNursingController::class, 'packages_nursing_reservations'])->name('packages_nursing_reservations');
Route::get('nursing_make_provider_price/{id}', [PackageNursingController::class, 'nursing_make_provider_price'])->name('nursing_make_provider_price');
Route::post('nursing_make_offer', [PackageNursingController::class, 'nursing_make_offer'])->name('nursing_make_offer');
Route::get('nursing_conv_messages/{id}', [PackageNursingController::class, 'nursing_conv_messages'])->name('nursing_conv_messages');
Route::post('nursin_send_message/{id}', [PackageNursingController::class, 'nursin_send_message'])->name('nursin_send_message');

Route::get('package_conv_messages/{id}', [PackageController::class, 'package_conv_messages'])->name('package_conv_messages');
Route::post('package_send_message/{id}', [PackageController::class, 'package_send_message'])->name('package_send_message');
Route::get('packag_make_price', [PackageController::class, 'packag_make_price'])->name('packag_make_price');
Route::post('package_make_offer', [PackageController::class, 'package_make_offer'])->name('package_make_offer');

Route::resource('packages_hospital', PackageHospitalController::class);
Route::get('packages_providers_reservations/{id}', [PackageHospitalController::class, 'packages_providers_reservations'])->name('packages_providers_reservations');
Route::post('provider_make_offer', [PackageHospitalController::class, 'provider_make_offer'])->name('provider_make_offer');
Route::get('make_provider_price/{id}', [PackageHospitalController::class, 'make_provider_price'])->name('make_provider_price');
Route::get('provider_conv_messages/{id}', [PackageHospitalController::class, 'provider_conv_messages'])->name('provider_conv_messages');
Route::post('provider_send_message/{id}', [PackageHospitalController::class, 'provider_send_message'])->name('provider_send_message');

Route::get('patient_schedules', [TreatmentServicesController::class, 'patient_schedules'])->name('patient_schedules');
Route::get('messages', [ConversationsController::class, 'messages'])->name('messages');
Route::post('reply_review/{id}', [ProvidersController::class, 'reply_review'])->name('reply_review');
Route::get('provider_schedules', [TreatmentServicesController::class, 'provider_schedules'])->name('provider_schedules');
Route::get('admin_patients', [PatientController::class, 'admin_patients'])->name('admin_patients');
Route::get('log_out', [PatientController::class, 'log_out'])->name('log_out');
Route::resource('package-options', PackageOptionController::class);

Route::resource('package-options-nursing', PackageOptionNursingController::class);
Route::get('edit_package-options-nursing/{id}', [PackageOptionNursingController::class, 'edit'])->name('edit_package-options-nursing');
Route::delete('destroy_package-options-nursing/{id}', [PackageOptionNursingController::class, 'destroy'])->name('destroy_package-options-nursing');
Route::resource('package-options-hospital', PackageOptionHospitalController::class);
Route::delete('delete_package_options_hospital', [PackageOptionHospitalController::class, 'delete_package_options_hospital'])->name('delete_package_options_hospital');

Route::group([], function () {
    Route::get('/chat/{id}', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

Route::get('conv_messages/{id}', [ConversationsController::class, 'conv_messages'])->name('conv_messages');

Route::get('my_nursing_bookings', [MyBookingsController::class, 'my_nursing_bookings'])->name('my_nursing_bookings');

Route::get('coupons', [CouponsController::class, 'coupons'])->name('coupons');
Route::get('create_coupon', [CouponsController::class, 'create_coupon'])->name('create_coupon');
Route::delete('delete_coupon/{id}', [CouponsController::class, 'delete_coupon'])->name('delete_coupon');
Route::get('edit_coupon/{id}', [CouponsController::class, 'edit_coupon'])->name('edit_coupon');
Route::post('store_coupon', [CouponsController::class, 'store_coupon'])->name('store_coupon');

Route::post('update_coupon/{id}', [CouponsController::class, 'update_coupon'])->name('update_coupon');
Route::post('nursing_pay', [MyBookingsController::class, 'nursing_pay'])->name('nursing_pay');

Route::get('my_provider_bookings', [MyBookingsController::class, 'my_provider_bookings'])->name('my_provider_bookings');
Route::post('provider_pay', [MyBookingsController::class, 'provider_pay'])->name('provider_pay');

Route::get('my_sick_bookings', [MyBookingsController::class, 'my_sick_bookings'])->name('my_sick_bookings');
Route::post('package_pay', [MyBookingsController::class, 'package_pay'])->name('package_pay');
