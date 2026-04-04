<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TreatmentService;
use App\Models\Specialty;
use App\Http\Requests\Web\AddTreatmentServiceRequest;
use Illuminate\Http\Request;

class TreatmentServicesController extends Controller
{
    public function index()
    {
        $services = TreatmentService::with('specialty')->paginate(10);
        return view('TreatmentServices.index', compact('services'));
    }

    public function create()
    {
        $specialties = Specialty::active()->get();
        return view('TreatmentServices.create', compact('specialties'));
    }

    public function store(AddTreatmentServiceRequest $request)
    {
        TreatmentService::create($request->validated());
        return redirect()->route('treatment-services.index')->with('success', 'Service added successfully');
    }

    public function edit($id)
    {
        $service = TreatmentService::findOrFail($id);
        $specialties = Specialty::active()->get();
        return view('TreatmentServices.edit', compact('service', 'specialties'));
    }

    public function update(AddTreatmentServiceRequest $request, $id)
    {
        $service = TreatmentService::findOrFail($id);
        $service->update($request->validated());
        return redirect()->route('treatment-services.index')->with('success', 'Service updated successfully');
    }

    public function destroy($id)
    {
        $service = TreatmentService::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully');
    }
}
