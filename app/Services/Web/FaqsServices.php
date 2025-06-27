<?php

namespace App\Services\Web;

use App\Models\Faq;

class FaqsServices
{
    static function GetFaqs(){
        $faqs=Faq::active()->get();
        return $faqs;
    }
    static function AddFaqs($data){
        $new=Faq::create($data);
        return $new;
    }
}
