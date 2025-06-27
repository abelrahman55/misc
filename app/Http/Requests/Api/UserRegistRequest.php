<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistRequest extends FormRequest
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
            'full_name'=>'required',
            'phone'=>'required|unique:users,phone',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'country'=>'required',
            'dob'=>'required',
            'role'=>'required',
        ];
    }
    public function messages()
{
    $lang = request()->header('lang', 'ar');

    $messages = [
        'ar' => [
            'full_name.required' => 'الاسم الكامل مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف موجود بالفعل',
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.unique' => 'البريد الإلكتروني موجود بالفعل',
            'password.required' => 'كلمة المرور مطلوبة',
            'country.required' => 'الدولة مطلوبة',
            'dob.required' => 'تاريخ الميلاد مطلوب',
            'role.required' => 'الدور (Role) مطلوب',
        ],
        'en' => [
            'full_name.required' => 'Full name is required',
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'Phone number already exists',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'country.required' => 'Country is required',
            'dob.required' => 'Date of birth is required',
            'role.required' => 'Role is required',
        ],
        'fr' => [
            'full_name.required' => 'Le nom complet est requis',
            'phone.required' => 'Le numéro de téléphone est requis',
            'phone.unique' => 'Le numéro de téléphone est deja utilisé',
            'email.required' => 'L\'e-mail est requis',
            'email.unique' => 'L\'e-mail est deja utilisé',
            'password.required' => 'Le mot de passe est requis',
            'country.required' => 'Le pays est requis',
            'dob.required' => 'La date de naissance est requise',
            'role.required' => 'Le rôle est requis',
        ],
        'gr' => [
            'full_name.required' => 'Vollständiger Name ist erforderlich',
            'phone.required' => 'Telefonnummer ist erforderlich',
            'phone.unique' => 'Telefonnummer ist bereits vorhanden',
            'email.required' => 'E-Mail ist erforderlich',
            'email.unique' => 'E-Mail ist bereits vorhanden',
            'password.required' => 'Passwort ist erforderlich',
            'country.required' => 'Land ist erforderlich',
            'dob.required' => 'Geburtsdatum ist erforderlich',
            'role.required' => 'Rolle ist erforderlich',
        ],
    ];

    return $messages[$lang] ?? $messages['en']; // fallback to English
}

}
