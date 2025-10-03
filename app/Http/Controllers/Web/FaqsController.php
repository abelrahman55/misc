<?php

namespace App\Http\Controllers\Web;


use App\Models\Faq;
use App\Models\Blog;
use App\Services\Web\FaqsServices;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AddFaqsRequest;

class FaqsController extends Controller
{
    public function __construct(public FaqsServices $faqsServices)
    {}

    public function index(){
        $faqs=$this->faqsServices->index();
        return view('Faqs.index',compact('faqs'));
    }
     public function create()
    {
        return view('Faqs.create');
    }

    public function store(AddFaqsRequest $request){
    $faqs=$this->faqsServices->store($request->validated());
        return redirect()->route('faqs.index');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('Faqs.edit',compact('faq'));
    }


    public function update(AddFaqsRequest $request, $id){
        $faqs=$this->faqsServices->update($request->validated(),$id);
               return redirect()->route('faqs.index');

    }

    public function delete($id){
        $faqs=$this->faqsServices->delete($id);
        if($faqs){
            return redirect()->back()->with('success','تم الحذف بنجاح');
        }
        return redirect()->back()->with('error','حدث خطأ');
    }


}
