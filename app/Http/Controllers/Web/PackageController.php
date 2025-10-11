<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageOption;
use Illuminate\Http\Request;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::with('options')->latest()->paginate(10);
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $package_options = PackageOption::all();
        return view('packages.create', compact('package_options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'options' => 'nullable|array',
        ]);

        $package = Package::create([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        if (!empty($data['options'])) {
            $package->options()->sync($data['options']);
        }

        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $package = Package::with('options')->findOrFail($id);
        return view('packages.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $package = Package::with('options')->findOrFail($id);
        $package_options = PackageOption::all();

        return view('packages.edit', compact('package', 'package_options'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|array',
            'title.ar' => 'required|string',
            'title.en' => 'required|string',
            'price' => 'required|numeric|min:0',
            'options' => 'nullable|array',
        ]);

        $package->update([
            'title' => $data['title'],
            'price' => $data['price'],
        ]);

        $package->options()->sync($data['options'] ?? []);

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->options()->detach();
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
