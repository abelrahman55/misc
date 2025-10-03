<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeAppointmentRequest extends FormRequest
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
            'commun_method'=>'required',
            'country_id'=>'required',
            'treatment_service_id'=>'required',
            'appoint_date'=>'required',
            'appoint_time'=>'required',
            'urgence_level'=>'required',
            'doctor_id'=>'required',
            'files'=>'required'
        ];
    }
}
