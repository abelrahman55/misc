<?php

namespace App\Http\Controllers\Web\DashboardPatient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Web\DashboardPatient\InquiryService;
use App\Http\Requests\Web\DashboardPatient\StoreInquiryRequest;
use App\Http\Requests\Web\DashboardPatient\UpdateInquiryRequest;

class InquiryController extends Controller
{

    public function __construct(public InquiryService $inquiryService){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->inquiryService->index();
        return view('dashboard_patient.inquiries.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard_patient.inquiries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInquiryRequest $request)
    {
        $this->inquiryService->store($request->validated());
        return redirect()->route('patient.inquiries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inquiry = $this->inquiryService->show($id);
        return view('dashboard_patient.inquiries.show',compact('inquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $inquiry = $this->inquiryService->show($id);
        return view('dashboard_patient.inquiries.edit',compact('inquiry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInquiryRequest $request, string $id)
    {
        $this->inquiryService->update($id,$request->validated());
        return redirect()->route('patient.inquiries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->inquiryService->destroy($id);
        return redirect()->route('patient.inquiries.index');
    }
}
