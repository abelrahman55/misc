<?php
namespace App\Http\Controllers\Web;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\PackageOption;
use App\Models\PackageNursing;
use App\Http\Controllers\Controller;
use App\Models\PackageNursingOption;
use App\Models\RelatedPackageOption;
use App\Models\RelatedPackageNursingOption;

class PackageNursingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = PackageNursing::with('optionsNursing')->latest()->paginate(10);
        return view('packages_nursing.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageNursingOption::all();
        return view('packages_nursing.create', compact('package_options'));
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

        $package = PackageNursing::create([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        if (! empty($data['options'])) {
            $package->optionsNursing()->sync($data['options']);
        }

        return redirect()->route('packages_nursing.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = PackageNursing::with('optionsNursing')->findOrFail($id);
        return view('packages_nursing.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package          = PackageNursing::with('optionsNursing')->findOrFail($id);
        $package_options  = PackageNursingOption::all();
        $selected_options = RelatedPackageNursingOption::where('package_nursing_id', $id)->pluck('package_nursing_option_id')->toArray();
        // return $package;
        return view('packages_nursing.edit', compact('package', 'package_options', 'selected_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $package = PackageNursing::findOrFail($id);

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

        $package->optionsNursing()->sync($data['options'] ?? []);

        return redirect()->route('packages_nursing.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = PackageNursing::findOrFail($id);
        $package->optionsNursing()->detach();
        $package->delete();

        return redirect()->route('packages_nursing.index')->with('success', 'Package deleted successfully.');
    }
}
