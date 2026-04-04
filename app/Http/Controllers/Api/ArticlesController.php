<?php

namespace App\Http\Controllers\Api;

use App\Services\Web\ArticlesServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticlesResource;

class ArticlesController extends Controller{

     public function __construct(public ArticlesServices $ArticlesServices){}

    public function index(){
        $Articless = $this->ArticlesServices->index();
        return res_data(ArticlesResource::collection($Articless), '', 200);
    }

}
