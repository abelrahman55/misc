<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeleconsultationRequest extends FormRequest
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
            'specialty_id' => 'required|exists:specialties,id',
            'complaint' => 'required|string',
            'appointment_date' => 'required|date_format:Y-m-d H:i:s',
            'medical_files' => 'nullable|array',
            'medical_files.*' => 'file', // 5MB limit
        ];
    }
}
