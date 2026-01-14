<?php

namespace App\Services\Api;

use App\Models\User;
use App\Models\UserAllergie;
use App\Models\UserLabol;
use App\Models\UserMedication;
use App\Models\UserNote;
use App\Models\UserSergical;
use App\Models\UserSurgery;
use App\Models\UserSurgeryType;
use Illuminate\Support\Facades\Auth;

class PatientDataServices{
    public static function CompleteData($data)
    {
        $user = Auth::guard('users')->user();

        // تحديث بيانات جدول users
        $userFields = [
            'gender', 'home_number', 'street_name', 'town', 'country', 'military_status', 'occupation', 'language',
            'f_name', 'm_name', 'l_name', 'relationship', 'mobile_number',
            'medications', 'allergies', 'dnr', 'organ_donation',
            'p_f_name', 'p_m_name', 'p_l_name', 'p_phone', 'p_email', 'p_home',
            'chro_ill_conditions', 'surgical_history', 'family_history',
            'smoking', 'alcohol', 'physical_activity', 'dietary_preferences',
            'heart_rate', 'blood_pressure', 'temperature', 'respiratory_rate', 'oxygen_saturation','type',
            'height', 'weight', 'waist_circumference',
            'prefered_hospital', 'prefered_clinic', 'prefered_specialist',
        ];

        foreach ($userFields as $field) {
            if (isset($data[$field])) {
                $user->$field = $data[$field]??null;
            }
        }
        $user->save();

        // Labodata
        if ($data['test_type'] ?? null || $data['file_test'] ?? null || $data['timeline'] ?? null || $data['date_of_studies'] ?? null || $data['file_imaging'] ?? null) {
            if(request()->hasFile('file_test')) {
                $data['file_test'] = PatientDataServices::UploadFile(request()->file('file_test'));
            }

            if(request()->hasFile('file_imaging')) {
                $data['file_imaging'] = PatientDataServices::UploadFile(request()->file('file_imaging'));
            }

            UserLabol::firstOrCreate([
                'user_id'         => $user->id,
                'test_type'       => $data['test_type'] ?? null,
                'file_test'       => $data['file_test'] ?? null,
                'timeline'        => $data['timeline'] ?? null,
                'date_of_studies' => $data['date_of_studies'] ?? null,
                'file_imaging'    => $data['file_imaging'] ?? null,
            ]);
        }

        // Medications
        if ($data['medication'] ?? null) {
            if(request()->hasFile('file_meds')) {
                $data['file_meds'] = PatientDataServices::UploadFile(request()->file('file_meds'));
            }
            UserMedication::firstOrCreate([
                'user_id'           => $user->id,
                'medication'        => $data['medication'],
                'dosage'            => $data['dosage'] ?? null,
                'frequency'         => $data['frequency'] ?? null,
                'pres_provider'     => $data['pres_provider'] ?? null,
                'adverse_reactions' => $data['adverse_reactions'] ?? null,
                'file_meds'         => $data['file_meds'] ?? null,
            ]);
        }

        // Surgeries
        if ($data['current_treatment'] ?? null) {
            if(request()->hasFile('file_surgery')) {
                $data['file_surgery'] = PatientDataServices::UploadFile(request()->file('file_surgery'));
            }
            UserSergical::firstOrCreate([
                'user_id'            => $user->id,
                'current_treatment'  => $data['current_treatment'],
                'start_date'         => $data['start_date'] ?? null,
                'duration'           => $data['duration'] ?? null,
                'past_procedures'    => $data['past_procedures'] ?? null,
                'surg_date'          => $data['surg_date'] ?? null,
                'surgeon'            => $data['surgeon'] ?? null,
                'outcomes'           => $data['outcomes'] ?? null,
                'reason_for_referral'=> $data['reason_for_referral'] ?? null,
                'recommendation'     => $data['recommendation'] ?? null,
                'file_surgery'       => $data['file_surgery'] ?? null,
            ]);
        }

        // Allergies
        if ($data['specific_drug'] ?? null || $data['reaction_details'] ?? null) {
            UserAllergie::firstOrCreate([
                'user_id'           => $user->id,
                'specific_drug'     => $data['specific_drug'] ?? null,
                'reaction_details'  => $data['reaction_details'] ?? null,
                'infor_environment' => $data['infor_environment'] ?? null,
                'specific_food'     => $data['specific_food'] ?? null,
                'insur_address'     => $data['insur_address'] ?? null,
                'insur_policy'     => $data['insur_policy'] ?? null,
                'insur_coverage'     => $data['insur_coverage'] ?? null,
                'bill_street_name'  => $data['bill_street_name'] ?? null,
                'bill_town'         => $data['bill_town'] ?? null,
                'bill_number'       => $data['bill_number'] ?? null,
                'preferred_payment' => $data['preferred_payment'] ?? null,
            ]);
        }

        // Notes
        if (!empty($data['note'])) {
            UserNote::create([
                'user_id' => $user->id,
                'note'    => $data['note'],
            ]);
        }

        return res_data([], __('تم التحديث بنجاح'), 200);
    }

    static function UploadFile($file){
        $file_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('files'), $file_name);
        return $file_name;
    }
}
