<?php

namespace App\Http\Controllers\Web;


use App\Services\Web\BlogServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreBlogRequest;

class BlogController extends Controller
{
    public function __construct(public BlogServices $blogServices)
    {}

    public function index(){
        $blogs=$this->blogServices->index();
        return res_data($blogs,'',200);
    }

    public function store(StoreBlogRequest $request){
    $blogs=$this->blogServices->store($request->validated());
        if($blogs){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function update(StoreBlogRequest $request, $id){
        $blogs=$this->blogServices->update($request->validated(),$id);
        if($blogs){
            return redirect()->back()->with('success','تم التحديث بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function delete($id){
        $blogs=$this->blogServices->delete($id);
        if($blogs){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }


}
