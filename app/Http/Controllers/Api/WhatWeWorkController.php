<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\WorkService;
use Illuminate\Http\Request;

class WhatWeWorkController extends Controller
{
    //
    public function get_works(){
        $works=WorkService::GetWorks();
        return $works;
    }
}
