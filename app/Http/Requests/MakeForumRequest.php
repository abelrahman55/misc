<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeForumRequest extends FormRequest
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
    public function prepareForValidation():void
    {
        $this->merge([
            'categories' => json_decode($this->categories)??[],
        ]);
    }
    public function rules(): array
    {
        return [
            //
            'title'=>'required',
            'content'=>'required',
            'categories'=>'required',
            'categories.*'=>'required|exists:specialties,id',
            'image'=>'nullable',
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'title.required'=>'الاسم مطلوب',
                'content.required'=>'الوصف مطلوب',
                'categories.required'=>'القسم مطلوب',
            ],
            'en'=>[
                'title.required'=>'Title is required',
                'content.required'=>'Description is required',
                'categories.required'=>'Category is required',
            ],
            'fr'=>[
                'title.required'=>'Le titre est requis',
                'content.required'=>'La description est requise',
                'categories.required'=>'La categorie est requise',
            ],
            'gr'=>[
                'title.required'=>'Το τιτλο είναι υποχρεωτικό',
                'content.required'=>'Η περιγραφή είναι υποχρεωτική',
                'categories.required'=>'Η κατηγορία είναι υποχρεωτική',
            ],
        ];
        return $messages[$lang];
    }

}
