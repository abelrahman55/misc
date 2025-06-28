<?php

namespace App\Http\Requests\Api\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class AddFeedbackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;     // اسمح للجميع، عدّل بحسب نظام الصلاحيات لديك
    }

    public function rules(): array
    {
        return [
            'name_coordinator'            => 'sometimes|nullable|string|max:255',
            'healthcare_provider'         => 'sometimes|nullable|string|max:255',
            'service_inquiry'             => 'sometimes|nullable|string|max:255',
            'service_date'                => 'sometimes|nullable|date',
            'rate'                        => 'sometimes|nullable|integer|min:1|max:5',
            'feedback'                    => 'sometimes|nullable|string',
            'is_easy'                     => 'sometimes|nullable|boolean',
            'text_no'                     => 'sometimes|nullable|string',
            'design_rate'                 => 'sometimes|nullable|integer|min:1|max:5',
            'is_clear_feature'            => 'sometimes|nullable|boolean',
            'improve_suggestion_feature'  => 'sometimes|nullable|string',
            'medical_rate'                => 'sometimes|nullable|integer|min:1|max:5',
            'is_satisfied_hospital'       => 'sometimes|nullable|boolean',
            'no_better_text'              => 'sometimes|nullable|string',
            'is_clear_plan'               => 'sometimes|nullable|boolean',
            'improve_suggestion_plan'     => 'sometimes|nullable|string',
            'is_finalize_plan'            => 'sometimes|nullable|boolean',
            'is_tech_experience'          => 'sometimes|nullable|boolean',
            'specify_text'                => 'sometimes|nullable|string',
            'loading_speed_rate'          => 'sometimes|nullable|integer|min:1|max:5',
            'is_cost_rate'                => 'sometimes|nullable|integer|min:1|max:5',
            'service_comment'             => 'sometimes|nullable|string',
            'would_contact'               => 'sometimes|nullable|boolean',
            'would_recommend'             => 'sometimes|nullable|boolean',
        ];
    }

    public function messages(): array
    {
        $lang = request()->header('lang', 'ar');

        $messages = [

            // ------------------ Arabic ------------------
            'ar' => [
                'name_coordinator.required'           => 'اسم المنسق مطلوب',
                'healthcare_provider.required'        => 'اسم مزود الرعاية الصحية مطلوب',
                'service_inquiry.required'            => 'موضوع الخدمة مطلوب',
                'service_date.required'               => 'تاريخ الخدمة مطلوب',
                'rate.required'                       => 'التقييم مطلوب',
                'feedback.required'                   => 'التعليق مطلوب',
                'is_easy.required'                    => 'هل كانت الخدمة سهلة؟ حقل مطلوب',
                'text_no.required'                    => 'يرجى توضيح سبب عدم سهولة الخدمة',
                'design_rate.required'                => 'تقييم التصميم مطلوب',
                'is_clear_feature.required'           => 'هل الميزة واضحة؟ حقل مطلوب',
                'improve_suggestion_feature.required' => 'يرجى تقديم اقتراحات لتحسين الميزة',
                'medical_rate.required'               => 'تقييم الخدمة الطبية مطلوب',
                'is_satisfied_hospital.required'      => 'هل أنت راضٍ عن المستشفى؟ حقل مطلوب',
                'no_better_text.required'             => 'يرجى ذكر ما يمكن تحسينه',
                'is_clear_plan.required'              => 'هل الخطة واضحة؟ حقل مطلوب',
                'improve_suggestion_plan.required'    => 'يرجى تقديم اقتراحات لتحسين الخطة',
                'is_finalize_plan.required'           => 'هل الخطة نهائية؟ حقل مطلوب',
                'is_tech_experience.required'         => 'هل لديك خبرة تقنية؟ حقل مطلوب',
                'specify_text.required'               => 'يرجى التحديد في الحقل',
                'loading_speed_rate.required'         => 'تقييم سرعة التحميل مطلوب',
                'is_cost_rate.required'               => 'تقييم التكلفة مطلوب',
                'service_comment.required'            => 'حقل تعليق الخدمة مطلوب',
                'would_contact.required'              => 'حقل هل ستتواصل معنا مجدداً؟ مطلوب',
                'would_recommend.required'            => 'حقل هل توصي بنا؟ مطلوب',
            ],

            // ------------------ French ------------------
            'fr' => [
                'name_coordinator.required'           => 'Le nom du coordinateur est obligatoire',
                'healthcare_provider.required'        => 'Le prestataire de soins est obligatoire',
                'service_inquiry.required'            => 'La nature du service est obligatoire',
                'service_date.required'               => 'La date du service est obligatoire',
                'rate.required'                       => 'La note est obligatoire',
                'feedback.required'                   => 'Le commentaire est obligatoire',
                'is_easy.required'                    => 'Le champ “service facile ?” est obligatoire',
                'text_no.required'                    => 'Veuillez préciser pourquoi ce n’était pas facile',
                'design_rate.required'                => 'La note du design est obligatoire',
                'is_clear_feature.required'           => 'Le champ “fonction claire ?” est obligatoire',
                'improve_suggestion_feature.required' => 'Veuillez suggérer des améliorations',
                'medical_rate.required'               => 'La note médicale est obligatoire',
                'is_satisfied_hospital.required'      => 'Le champ “satisfait de l’hôpital ?” est obligatoire',
                'no_better_text.required'             => 'Veuillez indiquer ce qui peut être amélioré',
                'is_clear_plan.required'              => 'Le champ “plan clair ?” est obligatoire',
                'improve_suggestion_plan.required'    => 'Veuillez suggérer des améliorations du plan',
                'is_finalize_plan.required'           => 'Le champ “plan finalisé ?” est obligatoire',
                'is_tech_experience.required'         => 'Le champ “expérience technique ?” est obligatoire',
                'specify_text.required'               => 'Veuillez préciser ce champ',
                'loading_speed_rate.required'         => 'La note de vitesse de chargement est obligatoire',
                'is_cost_rate.required'               => 'La note du coût est obligatoire',
                'service_comment.required'            => 'Le commentaire sur le service est obligatoire',
                'would_contact.required'              => 'Le champ “nous recontacteriez‑vous ?” est obligatoire',
                'would_recommend.required'            => 'Le champ “nous recommanderiez‑vous ?” est obligatoire',
            ],

            // ------------------ Greek ------------------
            'gr' => [
                'name_coordinator.required'           => 'Απαιτείται το όνομα του συντονιστή',
                'healthcare_provider.required'        => 'Απαιτείται ο πάροχος υγειονομικής περίθαλψης',
                'service_inquiry.required'            => 'Απαιτείται ο τύπος υπηρεσίας',
                'service_date.required'               => 'Απαιτείται η ημερομηνία υπηρεσίας',
                'rate.required'                       => 'Απαιτείται η αξιολόγηση',
                'feedback.required'                   => 'Απαιτείται σχόλιο',
                'is_easy.required'                    => 'Το πεδίο “Ήταν εύκολη η υπηρεσία;” είναι υποχρεωτικό',
                'text_no.required'                    => 'Παρακαλώ εξηγήστε γιατί δεν ήταν εύκολο',
                'design_rate.required'                => 'Απαιτείται αξιολόγηση σχεδίασης',
                'is_clear_feature.required'           => 'Το πεδίο “Είναι καθαρό το χαρακτηριστικό;” είναι υποχρεωτικό',
                'improve_suggestion_feature.required' => 'Παρακαλώ προτείνετε βελτιώσεις',
                'medical_rate.required'               => 'Απαιτείται ιατρική αξιολόγηση',
                'is_satisfied_hospital.required'      => 'Το πεδίο “Είστε ικανοποιημένος με το νοσοκομείο;” είναι υποχρεωτικό',
                'no_better_text.required'             => 'Παρακαλώ αναφέρετε τι θα μπορούσε να βελτιωθεί',
                'is_clear_plan.required'              => 'Το πεδίο “Είναι σαφές το πλάνο;” είναι υποχρεωτικό',
                'improve_suggestion_plan.required'    => 'Παρακαλώ προτείνετε βελτιώσεις στο πλάνο',
                'is_finalize_plan.required'           => 'Το πεδίο “Οριστικοποιήθηκε το πλάνο;” είναι υποχρεωτικό',
                'is_tech_experience.required'         => 'Το πεδίο “Έχετε τεχνική εμπειρία;” είναι υποχρεωτικό',
                'specify_text.required'               => 'Παρακαλώ προσδιορίστε το κείμενο',
                'loading_speed_rate.required'         => 'Απαιτείται αξιολόγηση ταχύτητας φόρτωσης',
                'is_cost_rate.required'               => 'Απαιτείται αξιολόγηση κόστους',
                'service_comment.required'            => 'Απαιτείται σχόλιο υπηρεσίας',
                'would_contact.required'              => 'Το πεδίο “Θα επικοινωνούσατε ξανά;” είναι υποχρεωτικό',
                'would_recommend.required'            => 'Το πεδίο “Θα μας προτείνατε;” είναι υποχρεωτικό',
            ],

            // ------------------ English ------------------
            'en' => [
                'name_coordinator.required'           => 'Coordinator name is required',
                'healthcare_provider.required'        => 'Healthcare provider is required',
                'service_inquiry.required'            => 'Service inquiry is required',
                'service_date.required'               => 'Service date is required',
                'rate.required'                       => 'Rate is required',
                'feedback.required'                   => 'Feedback is required',
                'is_easy.required'                    => '“Is the service easy?” field is required',
                'text_no.required'                    => 'Please specify why it was not easy',
                'design_rate.required'                => 'Design rate is required',
                'is_clear_feature.required'           => '“Is the feature clear?” field is required',
                'improve_suggestion_feature.required' => 'Please suggest feature improvements',
                'medical_rate.required'               => 'Medical rate is required',
                'is_satisfied_hospital.required'      => '“Are you satisfied with the hospital?” field is required',
                'no_better_text.required'             => 'Please specify what could be better',
                'is_clear_plan.required'              => '“Is the plan clear?” field is required',
                'improve_suggestion_plan.required'    => 'Please suggest plan improvements',
                'is_finalize_plan.required'           => '“Is the plan finalized?” field is required',
                'is_tech_experience.required'         => '“Do you have technical experience?” field is required',
                'specify_text.required'               => 'Please specify this field',
                'loading_speed_rate.required'         => 'Loading‑speed rate is required',
                'is_cost_rate.required'               => 'Cost rate is required',
                'service_comment.required'            => 'Service comment is required',
                'would_contact.required'              => '“Would you contact us again?” field is required',
                'would_recommend.required'            => '“Would you recommend us?” field is required',
            ],
        ];

        return $messages[$lang] ?? $messages['ar'];  // fallback للعربية في حال لم تتطابق اللغة
    }
}
