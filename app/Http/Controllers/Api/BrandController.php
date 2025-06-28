<?php

namespace App\Http\Controllers\Api;

use App\Services\Web\BrandServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;

class BrandController extends Controller{

    public function __construct(public BrandServices $BrandServices){}

    public function index()
    {
        $Brand = $this->BrandServices->index();
        return res_data( new BrandResource($Brand), '', 200);
    }

}
