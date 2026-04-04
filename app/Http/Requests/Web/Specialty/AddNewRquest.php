<?php

namespace App\Http\Requests\Web\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class AddNewRquest extends FormRequest
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
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string'],
            'title.en' => ['required', 'string'],
            'title.fr' => ['required', 'string'],
            'title.gr' => ['required', 'string'],
        ];
    }

    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'title.required'=>'الاسم مطلوب',
            ],
            'en'=>[
                'title.required'=>'Title is required',
            ],
            'fr'=>[
                'title.required'=>'Le titre est requis',
            ],
            'gr'=>[
                'title.required'=>'Το τιτλο είναι υποχρεωτικό',
            ],
        ];
        return $messages[$lang];
    }

}
