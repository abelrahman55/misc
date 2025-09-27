<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class MakeInqueriesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => 'required',
            'treatment_type' => 'required',
            'contact_details'=> 'required',
            'country_id'     => 'required',
            'specialty_id'   => 'required',
            'proximity'      => 'required',
            'budget'         => 'required',
            'symptoms'       => 'required',
            'reputation'     => 'required',
            'files'=>'sometimes'
        ];
    }

    public function messages(): array
    {
        $locale = request()->header('lang','ar'); // هيجيب اللغة الحالية من الـ app

        $messages = [
            'ar' => [
                'name.required'           => 'الاسم مطلوب',
                'treatment_type.required' => 'نوع العلاج مطلوب',
                'contact_details.required'=> 'بيانات الاتصال مطلوبة',
                'country_id.required'     => 'الدولة مطلوبة',
                'specialty_id.required'   => 'التخصص مطلوب',
                'proximity.required'      => 'القرب مطلوب',
                'budget.required'         => 'الميزانية مطلوبة',
                'symptoms.required'       => 'الأعراض مطلوبة',
                'reputation.required'     => 'السمعة مطلوبة',
            ],
            'en' => [
                'name.required'           => 'The name field is required.',
                'treatment_type.required' => 'The treatment type is required.',
                'contact_details.required'=> 'Contact details are required.',
                'country_id.required'     => 'The country is required.',
                'specialty_id.required'   => 'The specialty is required.',
                'proximity.required'      => 'Proximity is required.',
                'budget.required'         => 'Budget is required.',
                'symptoms.required'       => 'Symptoms are required.',
                'reputation.required'     => 'Reputation is required.',
            ],
            'fr' => [
                'name.required'           => 'Le nom est requis.',
                'treatment_type.required' => 'Le type de traitement est requis.',
                'contact_details.required'=> 'Les coordonnées sont requises.',
                'country_id.required'     => 'Le pays est requis.',
                'specialty_id.required'   => 'La spécialité est requise.',
                'proximity.required'      => 'La proximité est requise.',
                'budget.required'         => 'Le budget est requis.',
                'symptoms.required'       => 'Les symptômes sont requis.',
                'reputation.required'     => 'La réputation est requise.',
            ],
            'gr' => [
                'name.required'           => 'Το όνομα είναι υποχρεωτικό.',
                'treatment_type.required' => 'Ο τύπος θεραπείας είναι υποχρεωτικός.',
                'contact_details.required'=> 'Τα στοιχεία επικοινωνίας είναι υποχρεωτικά.',
                'country_id.required'     => 'Η χώρα είναι υποχρεωτική.',
                'specialty_id.required'   => 'Η ειδικότητα είναι υποχρεωτική.',
                'proximity.required'      => 'Η εγγύτητα είναι υποχρεωτική.',
                'budget.required'         => 'Ο προϋπολογισμός είναι υποχρεωτικός.',
                'symptoms.required'       => 'Τα συμπτώματα είναι υποχρεωτικά.',
                'reputation.required'     => 'Η φήμη είναι υποχρεωτική.',
            ],
        ];

        return $messages[$locale] ?? $messages['en'];
    }
}