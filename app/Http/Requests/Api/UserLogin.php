<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserLogin extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // إذا كان تسجيل دخول عادي
            'email' => 'required_without:provider',
            'password' => 'required_without:provider',
            // إذا تسجيل اجتماعي
            'provider' => 'required_with:provider_id|in:google,facebook,apple',
            'provider_id' => 'required_with:provider',
            'type'=> 'required_with:provider_id',
            'role'=> 'required_with:provider_id',
        ];
    }

    public function messages()
    {
        $lang = request()->header('lang','ar');
        $messages = [
            'ar'=>[
                'email.required_without'=>'البريد الإلكتروني مطلوب',
                'password.required_without'=>'كلمة المرور مطلوبة',
                'provider.required_with'=>'نوع الموفر مطلوب',
                'provider_id.required_with'=>'معرّف الموفر مطلوب',
            ],
            'en'=>[
                'email.required_without'=>'Email is required',
                'password.required_without'=>'Password is required',
                'provider.required_with'=>'Provider is required',
                'provider_id.required_with'=>'Provider ID is required',
            ],
        ];
        return $messages[$lang] ?? $messages['ar'];
    }
}
