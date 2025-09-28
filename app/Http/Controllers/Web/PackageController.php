<?php
namespace App\Http\Controllers\Web;

use App\Models\AboutUs;
use App\Models\Package;
use App\Http\Controllers\Controller;
use App\Services\Web\AboutUsServices;
use App\Http\Requests\Web\StoreAboutUsRequest;

class PackageController  extends Controller
{
    public function index()
    {
        $packages = Package::with('options')->get();
        return view('packages.index', compact('packages'));
    }

}
