<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PackageNursingOption;
use Illuminate\Http\Request;

class PackageOptionNursingController extends Controller
{
    public function index()
    {
        $options = PackageNursingOption::latest()->get();
        return view('package_options_nursing.index', compact('options'));
    }

    public function create()
    {
        return view('package_options_nursing.create');
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

        PackageNursingOption::create([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options-nursing.index')->with('success', 'Package option created successfully.');
    }

    public function edit(PackageNursingOption $package_option)
    {
        // return $package_option;
        $option = $package_option;
        // return $option;
        $id = request('package_options_nursing');
        // return $id;
        $option = PackageNursingOption::where('id', $id)->first();
        return view('package_options_nursing.edit', compact('option'));
    }
    // public function edit(PackageNursingOption $package_option)
    // {
    //     $option = $package_option;
    //     return $option;
    //     return view('package_options_nursing.edit', compact('option'));
    // }

    public function update(Request $request, PackageNursingOption $package_option)
    {
        // return $package_option;
        $data = $request->validate([
            'title'    => 'required|array',
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
            'title.fr' => 'required|string',
            'title.gr' => 'required|string',
        ]);
        // return $data;
        $package_option = PackageNursingOption::where('id', $request->id)->first();
        $package_option->update([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options-nursing.index')->with('success', 'Package option updated successfully.');
    }

    public function destroy(PackageNursingOption $package_option)
    {
        $id = request('id');
        // return $id;
        $package_option = PackageNursingOption::where('id', $id)->first();
        $package_option->delete();
        return redirect()->route('package-options-nursing.index')->with('success', 'Package option deleted successfully.');
    }
}
