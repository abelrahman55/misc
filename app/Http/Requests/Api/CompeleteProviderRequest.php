<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompeleteProviderRequest extends FormRequest
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
            'complaint' => 'required',
            'doctor_files' => 'required',
            'doctor_date' => 'required',
            'doctor_time' => 'required',
        ];
    }
}
