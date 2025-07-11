<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\SpecialistService;

class SpecialistsController extends Controller
{
    //
    public function our_specialist(){
        $specialist=SpecialistService::OurSpecialist();
        return $specialist;
    }
}
