<?php

namespace App\Http\Controllers\Web;


use App\Services\Web\ServiceServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreServiceRequest;

class ServiceController extends Controller
{
    public function __construct(public ServiceServices $ServiceServices)
    {}

    public function index(){
        $Services=$this->ServiceServices->index();
        return res_data($Services,'',200);
    }

    public function store(StoreServiceRequest $request){
    $Services=$this->ServiceServices->store($request->validated());
        if($Services){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function update(StoreServiceRequest $request, $id){
        $Services=$this->ServiceServices->update($request->validated(),$id);
        if($Services){
            return redirect()->back()->with('success','تم التحديث بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function delete($id){
        $Services=$this->ServiceServices->delete($id);
        if($Services){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }


}
