<?php

namespace App\Http\Controllers\Api;

use App\Services\Web\BlogServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

class BlogController extends Controller{

     public function __construct(public BlogServices $blogServices){}

    public function index(){
        $blogs = $this->blogServices->index();
        return res_data(BlogResource::collection($blogs), '', 200);
    }

}
