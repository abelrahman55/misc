<?php
namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MakeLikeForumRequest extends FormRequest
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
            'like' => 'nullable|boolean',
        ];
    }
    public function messages()
    {
        $lang     = request()->header('lang', 'ar');
        $messages = [
            'ar' => [
                'like.required' => 'الاسم مطلوب',
            ],
            'en' => [
                'like.required' => 'Title is required',
            ],
            'fr' => [
                'like.required' => 'Le titre est requis',
            ],
            'gr' => [
                'like.required' => 'Το τιτλο είναι υποχρεωτικό',
            ],
        ];
        return $messages[$lang];
    }

}
