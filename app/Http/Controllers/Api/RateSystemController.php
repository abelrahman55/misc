<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RateSystemRequest;
use App\Services\Api\RateSystemService;
use Illuminate\Http\Request;

class RateSystemController extends Controller
{
    //
    public function rate_system(RateSystemRequest $request){
        $rate=RateSystemService::RateSystem($request->validated());
        return $rate;
    }
    public function clients_rates(){
        $rates=RateSystemService::ClientRates();
        return $rates;
    }
}
