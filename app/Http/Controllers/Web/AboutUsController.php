<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreAboutUsRequest;
use App\Services\Web\AboutUsServices;

class AboutUsController extends Controller
{
    public function __construct(public AboutUsServices $AboutUsServices)
    {}

    public function index()
    {
        $AboutUs = $this->AboutUsServices->index();
        return res_data($AboutUs, '', 200);
    }

    public function store(StoreAboutUsRequest $request)
    {
        $AboutUs = $this->AboutUsServices->store($request->validated());
        if ($AboutUs) {
            return redirect()->back()->with('success', 'تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error', 'حدث خطأ');
    }

}
