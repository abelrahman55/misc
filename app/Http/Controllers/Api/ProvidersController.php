<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\ProviderService;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    //
    public function best_providers(){
        $top=ProviderService::BestProviders();
        return $top;
    }
}
