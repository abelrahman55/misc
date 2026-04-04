<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Http\Requests\Web\AddSpecialtyRequest;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    public function index()
    {
        $specialties = Specialty::paginate(10);
        return view('Specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('Specialties.create');
    }

    public function store(AddSpecialtyRequest $request)
    {
        Specialty::create($request->validated());
        return redirect()->route('specialties.index')->with('success', 'Specialty added successfully');
    }

    public function edit($id)
    {
        $specialty = Specialty::findOrFail($id);
        return view('Specialties.edit', compact('specialty'));
    }

    public function update(AddSpecialtyRequest $request, $id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->update($request->validated());
        return redirect()->route('specialties.index')->with('success', 'Specialty updated successfully');
    }

    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();
        return redirect()->back()->with('success', 'Specialty deleted successfully');
    }
}
