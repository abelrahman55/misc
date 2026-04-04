<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecialtyQuestion;

class SpecialtyQuestionsController extends Controller
{
    public function get_specialty_questions()
    {
        $lang = request()->header('lang', 'ar');
        $query = SpecialtyQuestion::active();

        $questions = $query->get()->map(function ($q) use ($lang) {
            return [
                'id' => $q->id,
                'question' => $q->question[$lang] ?? "",
                'answer' => $q->answer[$lang] ?? "",
            ];
        });

        return res_data($questions, '', 200);
    }
}
