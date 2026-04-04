<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingProviderServiceRequest;
use App\Models\BookingProvider;
use App\Models\BookingProviderOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingProviderController extends Controller
{
    //
    public function booking_provider(BookingProviderServiceRequest $request){
        $data=$request->validated();
        $user=Auth::guard('users')->user();
            $lang = request()->header('lang','ar'); // ar,en,fr,de
        $messages = [
        'ar' => [
            'success' => 'تم إنشاء الحجز بنجاح.',
            'fail'    => 'فشل إنشاء الحجز، حاول مرة أخرى.',
        ],
        'en' => [
            'success' => 'Booking created successfully.',
            'fail'    => 'Failed to create booking, please try again.',
        ],
        'fr' => [
            'success' => 'Réservation créée avec succès.',
            'fail'    => 'Échec de la création de la réservation, veuillez réessayer.',
        ],
        'de' => [
            'success' => 'Buchung erfolgreich erstellt.',
            'fail'    => 'Buchung konnte nicht erstellt werden, bitte versuchen Sie es erneut.',
        ],
    ];
        $new_booking=BookingProvider::create([
            'package_id'=>$request->package_id??0,
            'provider_id'=>$request->provider_id??0,
            'date'=>$request->date??null,
            'user_id'=>$user->id??0
        ]);
        if($new_booking){
            foreach($request->other_options??[] as $opt){
                BookingProviderOption::create([
                    'booking_id'=>$new_booking->id??0,
                    'package_option_id'=>$opt,
                ]);
            }
            return res_data('',$messages[$lang]['success'] ?? $messages['ar']['success'],200);
        }
        return res_data('',$messages[$lang]['fail'] ?? $messages['ar']['fail'],400);
    }
}
