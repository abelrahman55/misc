<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CompeleteProviderRequest;
use App\Services\Api\CompeleteProviderService;

class CompeleteProviderController{
    public function compelete_provider(CompeleteProviderRequest $request){
        $compelete=CompeleteProviderService::CompeleteProvider($request->validated());
        return $compelete;
    }
}
