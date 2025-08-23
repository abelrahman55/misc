<?php

namespace App\Http\Controllers\Web\DashboardPatient;


use App\Http\Controllers\Controller;
use App\Services\Web\DashboardPatient\DocumentCenterService;
use App\Http\Requests\Web\DashboardPatient\StoreDocumentCenterRequest;

class DocumentCenterController extends Controller
{
    public function __construct(public DocumentCenterService $documentCenterService){}

    public function index()
    {
        $data = $this->documentCenterService->index();
        return view('dashboard_patient.document_centers.index',compact('data'));
    }

    public function store(StoreDocumentCenterRequest $request)
    {
        $this->documentCenterService->store($request->validated());
        return redirect()->back();
    }

    public function destroy($id)
    {
         $this->documentCenterService->destroy($id);
        return redirect()->back();
    }




}
