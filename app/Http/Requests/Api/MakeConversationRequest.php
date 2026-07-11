<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MakeConversationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'receiver_id'=>'required|exists:users,id'
        ];
    }
    public function messages(): array
    {
        $lang=request()->header('lang','ar');
        return [
            'receiver_id.required'=>$lang=='ar'?'المستخدم مطلوب':'User is required',
            'receiver_id.exists'=>$lang=='ar'?'المستخدم غير موجود':'User not found',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}