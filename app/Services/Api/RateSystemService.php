<?php

namespace App\Services\Api;

use App\Models\RateSystem;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RateSystemService{
    static function RateSystem($data){
        $user=FacadesAuth::guard('users')->user();
        $data['user_id']=$user->id;
        $rate=RateSystem::create($data);
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
        // return $rate;
    }
    static function ClientRates(){
        $per_page = request()->query('per_page', 10);
        $rates=RateSystem::with('user')->where('status',1)->paginate($per_page);

        $rates->getCollection()->transform(function ($rate) {
            return [
                'id'         => $rate->id,
                'user_id'    => $rate->user_id,
                'user_name'  => $rate->user->full_name,
                'comment'    => $rate->comment,
                'rate'       => $rate->rate,
                'created_at' => $rate->created_at,
            ];
        });
        $data=[
            'data'=>$rates->getCollection()->toArray(),
            'pagination'=>[
                'total'=>$rates->total(),
                'count'=>$rates->count(),
                'per_page'=>$per_page,
                'current_page'=>$rates->currentPage(),
                'total_pages'=>$rates->lastPage(),
            ]
        ];
        return res_data($data,'',200);
    }
}
