<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BookingProviderServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'package_id'    => 'required',
            'other_options' => 'sometimes',
            'provider_id'   => 'required',
            'date'          => 'required|date',
        ];
    }

    public function messages(): array
    {
        $lang = request()->header('lang', 'ar'); // default ar

        $messages = [
            'ar' => [
                'package_id.required'  => 'الرجاء اختيار الباقة.',
                'provider_id.required' => 'الرجاء اختيار مقدم الخدمة.',
                'date.required'        => 'الرجاء إدخال التاريخ.',
                'date.date'            => 'صيغة التاريخ غير صحيحة.',
            ],
            'en' => [
                'package_id.required'  => 'Please select a package.',
                'provider_id.required' => 'Please select a provider.',
                'date.required'        => 'Please provide a date.',
                'date.date'            => 'The date format is invalid.',
            ],
            'fr' => [
                'package_id.required'  => 'Veuillez sélectionner un forfait.',
                'provider_id.required' => 'Veuillez sélectionner un prestataire.',
                'date.required'        => 'Veuillez fournir une date.',
                'date.date'            => 'Le format de la date est invalide.',
            ],
            'gr' => [ // German
                'package_id.required'  => 'Bitte wählen Sie ein Paket aus.',
                'provider_id.required' => 'Bitte wählen Sie einen Anbieter aus.',
                'date.required'        => 'Bitte geben Sie ein Datum an.',
                'date.date'            => 'Das Datumsformat ist ungültig.',
            ],
        ];

        return $messages[$lang] ?? $messages['ar']; // fallback
    }
}
