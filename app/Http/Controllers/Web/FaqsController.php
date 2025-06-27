<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AddFaqsRequest;
use App\Models\Faq;
use App\Services\Web\FaqsServices;
use Illuminate\Http\Request;

class FaqsController extends Controller{
    public function store_new_faqs(AddFaqsRequest $request){
        $insert=FaqsServices::AddFaqs($request->validated());
        if($insert){
            return redirect()->back()->with('success','تمت الاضافه بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }
}