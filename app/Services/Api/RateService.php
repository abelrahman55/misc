<?php

namespace App\Services\Api;

use App\Models\RateUser;
use Illuminate\Support\Facades\Auth;

class RateService{
    static function MakeRate($data){
        $user=Auth::guard('users')->user();
        $data['user_id']=$user->id;
        $rate=RateUser::create($data);
        if($rate){
            $message=[
                'ar'=>'تم التقييم بنجاح',
                'en'=>'Rated successfully',
                'fr'=>'Noté avec succès',
                'gr'=>'Κατασκευήστηκε με επιτυχία',
            ];
            return res_data('',$message[request()->header('lang','ar')],200);
        }
        $message=[
            'ar'=>'حدث خطاء',
            'en'=>'An error occurred',
            'fr'=>'Une erreur s\'est produite',
            'gr'=>'Παρουσιάστηκε σφάλμα',
        ];
        return res_data('',$message[request()->header('lang','ar')],400);
    }
}
