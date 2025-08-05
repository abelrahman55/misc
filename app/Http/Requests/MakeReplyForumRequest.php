<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeReplyForumRequest extends FormRequest
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
            'reply'=>'required',

        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'reply.required'=>'الاسم مطلوب',
            ],
            'en'=>[
                'reply.required'=>'Title is required',
            ],
            'fr'=>[
                'reply.required'=>'Le titre est requis',
            ],
            'gr'=>[
                'reply.required'=>'Το τιτλο είναι υποχρεωτικό',
            ],
        ];
        return $messages[$lang];
    }

}
