<?php

namespace App\Http\Controllers\Web;

use App\Services\Web\ArticlesServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreArticlesRequest;

class ArticlesController extends Controller
{
    public function __construct(public ArticlesServices $ArticlesServices)
    {}

    public function index(){
        $Articless=$this->ArticlesServices->index();
        return res_data($Articless,'',200);
    }

    public function store(StoreArticlesRequest $request){
    $Articless=$this->ArticlesServices->store($request->validated());
        if($Articless){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function update(StoreArticlesRequest $request, $id){
        $Articless=$this->ArticlesServices->update($request->validated(),$id);
        if($Articless){
            return redirect()->back()->with('success','تم التحديث بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }

    public function delete($id){
        $Articless=$this->ArticlesServices->delete($id);
        if($Articless){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }


}
