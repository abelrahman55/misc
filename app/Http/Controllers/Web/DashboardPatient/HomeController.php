<?php

namespace App\Http\Controllers\Web\DashboardPatient;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{



    public function index()
    {
        return view('dashboard_patient.home');
    }




}
