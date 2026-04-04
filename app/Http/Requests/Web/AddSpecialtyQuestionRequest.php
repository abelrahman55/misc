<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class AddSpecialtyQuestionRequest extends FormRequest
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
            'question' => ['required', 'array'],
            'question.ar' => ['required', 'string'],
            'question.en' => ['required', 'string'],
            'question.fr' => ['nullable', 'string'],
            'question.gr' => ['nullable', 'string'],

            'answer' => ['required', 'array'],
            'answer.ar' => ['required', 'string'],
            'answer.en' => ['required', 'string'],
            'answer.fr' => ['nullable', 'string'],
            'answer.gr' => ['nullable', 'string'],
        ];
    }
}
