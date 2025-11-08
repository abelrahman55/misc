<?php
namespace App\Http\Controllers\Web;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PackageOption;
use App\Models\PackageNursing;
use App\Models\PackageHospital;
use App\Http\Controllers\Controller;
use App\Models\PackageNursingOption;
use App\Models\RelatedPackageOption;
use App\Models\PackageHospitalOption;
use App\Models\RelatedPackageNursingOption;
use App\Models\RelatedPackageHospitalOption;

class PackageHospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = PackageHospital::with('optionsHospital')->latest()->paginate(10);
        return view('packages_hospital.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageHospitalOption::all();
        return view('packages_hospital.create', compact('package_options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package = PackageHospital::create([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        if (! empty($data['options'])) {
            $package->optionsHospital()->sync($data['options']);
        }

        return redirect()->route('packages_hospital.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = PackageHospital::with('optionsHospital')->findOrFail($id);
        return view('packages_hospital.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package          = PackageHospital::with('optionsHospital')->findOrFail($id);
        $package_options  = PackageHospitalOption::all();
        $selected_options = RelatedPackageHospitalOption::where('package_hospital_id', $id)->pluck('package_hospital_option_id')->toArray();
        // return $package;
        return view('packages_hospital.edit', compact('package', 'package_options', 'selected_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $package = PackageHospital::findOrFail($id);

        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
            'price'    => 'required|numeric|min:0',
            'options'  => 'nullable|array',
        ]);

        $package->update([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        $package->optionsHospital()->sync($data['options'] ?? []);

        return redirect()->route('packages_hospital.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = PackageHospital::findOrFail($id);
        $package->optionsHospital()->detach();
        $package->delete();

        return redirect()->route('packages_hospital.index')->with('success', 'Package deleted successfully.');
    }
}
