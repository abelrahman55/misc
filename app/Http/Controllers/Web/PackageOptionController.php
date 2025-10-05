<?php

namespace App\Http\Controllers\Web;

use App\Models\PackageOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageOptionController extends Controller
{
    public function index()
    {
        $options = PackageOption::latest()->get();
        return view('package_options.index', compact('options'));
    }

    public function create()
    {
        return view('package_options.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
        ]);

        PackageOption::create([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options.index')->with('success', 'Package option created successfully.');
    }

    public function edit(PackageOption $option)
    {
        return view('package_options.edit', compact('option'));
    }

    public function update(Request $request, PackageOption $option)
    {
        $data = $request->validate([
            'title' => 'required|array',
            'title.ar' => 'required|string|max:255',
            'title.en' => 'required|string|max:255',
        ]);

        $option->update([
            'title' => $data['title'],
        ]);

        return redirect()->route('package-options.index')->with('success', 'Package option updated successfully.');
    }

    public function destroy(PackageOption $option)
    {
        $option->delete();
        return redirect()->route('package-options.index')->with('success', 'Package option deleted successfully.');
    }
}
