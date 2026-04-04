<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqsController extends Controller{
    public function get_faqs(){
        $lang=request()->header('lang','ar');
        $faqs=Faq::active()->get()->map(function($faq)use ($lang){
            return [
                'id'=>$faq->id,
                'question'=>$faq->question[$lang]??"",
                'answer'=>$faq->answer[$lang]??"",
            ];
        });
        return res_data($faqs,'',200);
    }
}
