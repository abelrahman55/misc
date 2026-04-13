<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorProfileRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'legal_business_name' => 'nullable|string|max:255',
            'healthcare_facility_type' => 'nullable|string|max:255',
            'town_id' => 'nullable|exists:towns,id',
            'main_point_contact' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'content_blog' => 'nullable|string',
            'service_offered' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
            'pricing_information' => 'nullable|string',
            'technology' => 'nullable|string',
            'quality' => 'nullable|string',
            'preferred_partnership' => 'nullable|string',
            'facebook_link' => 'nullable|url|max:255',
            'twitter_link' => 'nullable|url|max:255',
            'linkedin_link' => 'nullable|url|max:255',
            'tiktok_link' => 'nullable|url|max:255',

            // Medical Staff validation
            'medical_staffs' => 'nullable|array',
            'medical_staffs.*.name' => 'required|string|max:255',
            'medical_staffs.*.qualification' => 'nullable|string|max:255',
            'medical_staffs.*.experience_years' => 'nullable|string|max:255',
            'medical_staffs.*.specialization' => 'nullable|string|max:255',

            // Licenses validation - multiple files per type
            'licenses' => 'nullable|array',
            'licenses.operating' => 'nullable|array',
            'licenses.operating.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.accreditation' => 'nullable|array',
            'licenses.accreditation.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.professional' => 'nullable|array',
            'licenses.professional.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.testimonials' => 'nullable|array',
            'licenses.testimonials.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.prof_photo' => 'nullable|array',
            'licenses.prof_photo.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.other_certs' => 'nullable|array',
            'licenses.other_certs.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.facility' => 'nullable|array',
            'licenses.facility.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.prom_content' => 'nullable|array',
            'licenses.prom_content.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'licenses.virtual_tour_video' => 'nullable|array',
            'licenses.virtual_tour_video.*' => 'file|mimes:mp4,avi,mov',
            'licenses.patient_success' => 'nullable|array',
            'licenses.patient_success.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
            'role'=>'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب',
            'email.exists' => 'البريد الإلكتروني غير موجود في النظام',
            'town_id.exists' => 'المدينة المختارة غير موجودة',
            'website.url' => 'رابط الموقع غير صحيح',
            'medical_staffs.*.name.required' => 'اسم الموظف مطلوب',
        ];
    }
}
