<?php

namespace Modules\Conversations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'conversation_id'=>'required|exists:conversations,id',
            'message'=>'required',
            // 'receiver_id'=>'required|exists:clients,id',
        ];
    }
    public function messages(){
        $lang=request()->header('lang','ar');
        return [
            'conversation_id.required'=>$lang=='ar'?'المحادثة مطلوبة':'Conversation is required',
            'conversation_id.exists'=>$lang=='ar'?'المحادثة غير صحيحة':'Conversation is not valid',
            'message.required'=>$lang=='ar'?'الرسالة مطلوبة':'Message is required',
            // 'receiver_id.required'=>$lang=='ar'?'المستخدم مطلوب':'User is required',
            // 'receiver_id.exists'=>$lang=='ar'?'المستخدم غير موجود':'User not found',
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
