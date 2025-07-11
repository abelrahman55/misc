<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MakeRateRequest extends FormRequest
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
            'rate' => 'required',
            'comment' => 'required',
            'provider_id' => 'required|exists:users,id',
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'rate.required'=>'التقييم مطلوب',
                'comment.required'=>'التعليق مطلوب',
                'provider_id.required'=>'المزود مطلوب',
                'provider_id.exists'=>'المزود غير صحيح',
            ],
            'en'=>[
                'rate.required'=>'Rate is required',
                'comment.required'=>'Comment is required',
                'provider_id.required'=>'Provider is required',
                'provider_id.exists'=>'Provider is not valid',
            ],
            'fr'=>[
                'rate.required'=>'La note est requise',
                'comment.required'=>'Le commentaire est requis',
                'provider_id.required'=>'Le fournisseur est requis',
                'provider_id.exists'=>'Le fournisseur n\'est pas valide',
            ],
            'gr'=>[
                'rate.required'=>'Η βαθμολογία είναι υποχρεωτική',
                'comment.required'=>'Το σχόλιο είναι υποχρεωτικό',
                'provider_id.required'=>'Ο προμηθευτής είναι υποχρεωτικός',
                'provider_id.exists'=>'Ο προμηθευτής δεν είναι έγκυρος',
            ],
        ];
        return $messages[$lang];
    }
}
