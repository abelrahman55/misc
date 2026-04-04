<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    public $table = 'feedbacks';
    protected $fillable = [
    'name_coordinator',
    'healthcare_provider',
    'service_inquiry',
    'user_id',
    'service_date',
    'rate',
    'feedback',
    'is_easy',
    'text_no',
    'feature_comment',
    'design_rate',
    'is_clear_feature',
    'improve_suggestion_feature',
    'medical_rate',
    'is_satisfied_hospital',
    'no_better_text',
    'is_clear_plan',
    'improve_suggestion_plan',
    'is_finalize_plan',
    'is_tech_experience',
    'specify_text',
    'loading_speed_rate',
    'is_cost_rate',
    'service_comment',
    'would_contact',
    'would_recommend',


    'tech_rate',
    'is_statis_hos_options',
    'not_satisfy_tech',
    'is_clear_estimated',
    'improve_suggestion_estimated',
    'is_final_treat_plan',
    'is_exper_tech_issue',
    'text_specify',
    'page_load',
    'is_service_worth_cost',
    'comment_tech',
    'feature_wants',
    'tech_would_contact',
    'is_recommend',
];

}
