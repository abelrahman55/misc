<?php

namespace App\Http\Controllers;

use App\Services\Api\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //
    public function patient_data(){
        $data=PatientService::GetPatientData();
        return $data;
    }
}