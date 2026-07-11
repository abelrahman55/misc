<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageHospitalOption;
use Illuminate\Http\Request;

class PackageOptionHospitalController extends Controller
{
    public function index()
    {
        $options = PackageHospitalOption::latest()->get();
        return view('package_options_hospital.index', compact('options'));
    }

    public function create()
    {
        return view('package_options_hospital.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
        ]);

        PackageHospitalOption::create([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options-hospital.index')->with('success', 'Package option created successfully.');
    }

    public function edit(PackageHospitalOption $package_option)
    {
        // return $package_option;
        $option = $package_option;
        return view('package_options_hospital.edit', compact('option'));
    }

    public function show($id)
    {
        $package = PackageHospitalOption::findOrFail($id);
        return view('package_options_hospital.show', compact('package'));
    }

    public function update(Request $request, PackageHospitalOption $package_option)
    {
        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
        ]);

        $package_option->update([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options-hospital.index')->with('success', 'Package option updated successfully.');
    }

    public function destroy(PackageHospitalOption $package_option)
    {
        // return $package_option;
        $package_option->delete();
        return redirect()->route('package-options-hospital.index')->with('success', 'Package option deleted successfully.');
    }
    public function delete_package_options_hospital()
    {
        $id             = request('id');
        $package_option = PackageHospitalOption::where('id', $id)->first();
        // return $id;
        // return $package_option;
        $package_option->delete();
        return redirect()->route('package-options-hospital.index')->with('success', 'Package option deleted successfully.');
    }
}
