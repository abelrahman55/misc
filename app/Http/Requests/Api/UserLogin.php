<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserLogin extends FormRequest
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
            'email'=>'required',
            'password'=>'required',
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'email.required'=>'البريد الإلكتروني مطلوب',
                'password.required'=>'كلمة المرور مطلوبة',
            ],
            'en'=>[
                'email.required'=>'Email is required',
                'password.required'=>'Password is required',
            ],
            'fr'=>[
                'email.required'=>'L\'e-mail est requis',
                'password.required'=>'Le mot de passe est requis',
            ],
            'gr'=>[
                'email.required'=>'Το email είναι υποχρεωτικό',
                'password.required'=>'Το κωδικό είναι υποχρεωτικό',
            ]
        ];
        return $messages[$lang];
    }
}
