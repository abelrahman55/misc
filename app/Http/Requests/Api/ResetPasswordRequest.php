<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        $messages=[
            'ar'=>[
                'email.required'=>'البريد الإلكتروني مطلوب',
                'email.exists'=>'البريد الإلكتروني غير صحيح',
                'password.required'=>'كلمة المرور مطلوبة',
            ],
            'en'=>[
                'email.required'=>'Email is required',
                'email.exists'=>'Email is not valid',
                'password.required'=>'Password is required',
            ],
            'fr'=>[
                'email.required'=>'L\'e-mail est requis',
                'email.exists'=>'L\'e-mail n\'est pas valide',
                'password.required'=>'Le mot de passe est requis',
            ],
            'gr'=>[
                'email.required'=>'Το email είναι υποχρεωτικό',
                'email.exists'=>'Το email δεν είναι έγκυρο',
                'password.required'=>'Το κωδικό είναι υποχρεωτικό',
            ],
        ];
        return $messages[$lang];
    }
}