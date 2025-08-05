<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MakeRateRequest;
use App\Services\Api\RateService;
use Illuminate\Http\Request;

class RateUserController extends Controller
{
    //
    public function make_rate(MakeRateRequest $request){
        $rate=RateService::MakeRate($request->validated());
        return $rate;
    }
}
