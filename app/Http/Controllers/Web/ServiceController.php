<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreServiceRequest;
use App\Models\Service;
use App\Services\Web\ServiceServices;

class ServiceController extends Controller
{
    public function __construct(public ServiceServices $ServiceServices)
    {}

    public function index()
    {
        $services = $this->ServiceServices->index();
        return view('Service.index', compact('services'));

    }

    public function create()
    {
        return view('Service.create');
    }

    public function store(StoreServiceRequest $request)
    {
        $Services = $this->ServiceServices->store($request->validated());
        return redirect()->route('services.index');

    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('Service.edit', compact('service'));
    }

    public function update(StoreServiceRequest $request, $id)
    {
        $Services = $this->ServiceServices->update($request->validated(), $id);
        return redirect()->route('services.index');

    }

    public function delete($id)
    {
        $Services = $this->ServiceServices->delete($id);
        if ($Services) {
            return redirect()->back()->with('success', 'تم الحذف بنجاح');
        }
        return redirect()->back()->with('error', 'حدث خطأ');
    }

}
