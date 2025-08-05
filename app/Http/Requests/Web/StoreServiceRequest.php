<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string'],
            'title.en' => ['required', 'string'],
            'title.fr' => ['nullable', 'string'],
            'title.gr' => ['nullable', 'string'],

            'description' => ['required', 'array'],
            'description.ar' => ['required', 'string'],
            'description.en' => ['required', 'string'],
            'description.fr' => ['nullable', 'string'],
            'description.gr' => ['nullable', 'string'],

            'image' => ['required', 'image', 'max:2048'],
            'status' => ['required', 'boolean'],
        ];
    }
}
