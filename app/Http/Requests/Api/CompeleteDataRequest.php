<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompeleteDataRequest extends FormRequest
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
            'gender'=>'nullable',
            'home_number'=>'nullable',
            'street_name'=>'nullable',
            'town'=>'nullable',
            'country'=>'nullable',
            'military_status'=>'nullable',
            'occupation'=>'nullable',
            'language'=>'nullable',
            'f_name'=>'nullable',
            'm_name'=>'nullable',
            'l_name'=>'nullable',
            'relationship'=>'nullable',
            'mobile_number'=>'nullable',
            'medications'=>'nullable',
            'allergies'=>'nullable',
            'dnr'=>'nullable',
            'organ_donation'=>'nullable',
            'p_f_name'=>'nullable',
            'p_m_name'=>'nullable',
            'p_l_name'=>'nullable',
            'p_phone'=>'nullable',
            'p_email'=>'nullable',
            'p_home'=>'nullable',
            'chro_ill_conditions'=>'nullable',
            'surgical_history'=>'nullable',
            'family_history'=>'nullable',
            'smoking'=>'nullable',
            'alcohol'=>'nullable',
                        'type'                => 'nullable|in:doctor,hospital,hotel,patient',

            'physical_activity'=>'nullable',
            'dietary_preferences'=>'nullable',
            'heart_rate'=>'nullable',
            'blood_pressure'=>'nullable',
            'temperature'=>'nullable',
            'respiratory_rate'=>'nullable',
            'oxygen_saturation'=>'nullable',
            'height'=>'nullable',
            'weight'=>'nullable',
            'waist_circumference'=>'nullable',
            'prefered_hospital'=>'nullable',
            'prefered_clinic'=>'nullable',
            'prefered_specialist'=>'nullable',

            //labodata
            'test_type'=>'nullable',
            'file_test'=>'nullable',
            'timeline'=>'nullable',
            'date_of_studies'=>'nullable',
            'file_imaging'=>'nullable',

            //current medications
            'medication'=>'nullable',
            'dosage'=>'nullable',
            'frequency'=>'nullable',
            'pres_provider'=>'nullable',
            'adverse_reactions'=>'nullable',
            'file_meds'=>'nullable',

            'role'=>'required',

            //surgeries
            'current_treatment'=>'nullable',
            'start_date'=>'nullable',
            'duration'=>'nullable',
            'past_procedures'=>'nullable',
            'surg_date'=>'nullable',
            'surgeon'=>'nullable',
            'outcomes'=>'nullable',
            'reason_for_referral'=>'nullable',
            'recommendation'=>'nullable',
            'file_surgery'=>'nullable',

            //allergies
            'specific_drug'=>'nullable',
            'reaction_details'=>'nullable',
            'infor_environment'=>'nullable',
            'specific_food'=>'nullable',
            'insur_address'=>'nullable',
            'insur_policy'=>'nullable',
            'insur_coverage'=>'nullable',
            'bill_street_name'=>'nullable',
            'bill_town'=>'nullable',
            'bill_number'=>'nullable',
            'preferred_payment'=>'nullable',

            //notes
            'note'=>'nullable',
        ];
    }
}
