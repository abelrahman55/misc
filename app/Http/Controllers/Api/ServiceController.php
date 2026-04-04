<?php

namespace App\Http\Controllers\Api;

use App\Services\Web\ServiceServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller{

     public function __construct(public ServiceServices $ServiceServices){}

    public function index(){
        $Services = $this->ServiceServices->index();
        return res_data(ServiceResource::collection($Services), '', 200);
    }

}
