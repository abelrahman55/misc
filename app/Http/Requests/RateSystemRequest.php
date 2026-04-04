<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateSystemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'comment'=>'required',
            'rate'=>'required'
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'comment.required'=>'التعليق مطلوب',
                'rate.required'=>'التقييم مطلوب',
            ],
            'en'=>[
                'comment.required'=>'Comment is required',
                'rate.required'=>'Rate is required',
            ],
            'fr'=>[
                'comment.required'=>'Le commentaire est requis',
                'rate.required'=>'La note est requise',
            ],
            'gr'=>[
                'comment.required'=>'Το σχόλιο είναι υποχρεωτικό',
                'rate.required'=>'Η βαθμολογία είναι υποχρεωτική',
            ],
        ];
        return $messages[$lang];
    }
}
