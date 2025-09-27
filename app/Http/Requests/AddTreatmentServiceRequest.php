<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTreatmentServiceRequest extends FormRequest
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
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string'],
            'title.en' => ['required', 'string'],
            'title.fr' => ['nullable', 'string'], // or 'required' if mandatory
            'title.gr' => ['nullable', 'string'], // or 'required' if mandatory

        ];
    }
}
