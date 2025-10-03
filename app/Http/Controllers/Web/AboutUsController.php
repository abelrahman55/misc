<?php
namespace App\Http\Controllers\Web;

use App\Models\AboutUs;
use App\Http\Controllers\Controller;
use App\Services\Web\AboutUsServices;
use App\Http\Requests\Web\StoreAboutUsRequest;

class AboutUsController extends Controller
{
    public function __construct(public AboutUsServices $AboutUsServices)
    {}

    public function index()
    {
        $AboutUs = $this->AboutUsServices->index();
        return res_data($AboutUs, '', 200);
    }

    public function create()
    {
        $about_us = AboutUs::first();
        return view('AboutUs.create',compact('about_us'));
    }

    public function store(StoreAboutUsRequest $request)
    {
        $AboutUs = $this->AboutUsServices->store($request->validated());
        return redirect()->back();
    }

}
