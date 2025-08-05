<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //
    public function get_services(){
        $lang=request()->header('lang', 'en');
        $services=Service::get()->map(function ($service) use ($lang) {
            $service->title = $service->title[$lang] ?? $service->title['en'];
            $service->description = $service->description[$lang] ?? $service->description['en'];
            return $service;
        });
        return res_data($services, 200);
    }
}