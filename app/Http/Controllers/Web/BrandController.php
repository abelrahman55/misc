<?php

namespace App\Http\Controllers\Web;

use App\Models\Brand;
use App\Services\Web\BrandServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreBrandRequest;

class BrandController extends Controller
{
    public function __construct(public BrandServices $BrandServices)
    {}

    public function index(){
        $Brands=$this->BrandServices->index();
        return res_data($Brands,'',200);
    }

    public function create()
    {
        $brand = Brand::first();
        return view('Brand.create',compact('brand'));
    }

    public function store(StoreBrandRequest $request){
    $Brand=$this->BrandServices->store($request->validated());
        if($Brand){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }



}
