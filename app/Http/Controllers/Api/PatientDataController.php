<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CompeleteDataRequest;
use App\Services\Api\PatientDataServices;

class PatientDataController extends Controller
{
    public function complete_data(CompeleteDataRequest $request){
        $update=PatientDataServices::CompleteData($request->validated());
        return $update;
    }
    //
}
