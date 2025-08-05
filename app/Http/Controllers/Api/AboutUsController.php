<?php

namespace App\Http\Controllers\Api;

use App\Services\Web\AboutUsServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;

class AboutUsController extends Controller{

    public function __construct(public AboutUsServices $AboutUsServices){}

    public function index()
    {
        $AboutUs = $this->AboutUsServices->index();
        return res_data( new AboutUsResource($AboutUs), '', 200);
    }

}
