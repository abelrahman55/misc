<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('name_coordinator')->nullable();
            $table->string('healthcare_provider')->nullable();
            $table->string('service_inquiry')->nullable();
            $table->string('service_date')->nullable();
            $table->tinyInteger('rate')->nullable();
            $table->string('feedback')->nullable();
            $table->tinyInteger('is_easy')->nullable();
            $table->longText('text_no')->nullable();
            $table->tinyInteger('design_rate')->nullable();
            $table->tinyInteger('is_clear_feature')->nullable();
            $table->longText('improve_suggestion_feature')->nullable();
            $table->tinyInteger('medical_rate')->nullable();
            $table->tinyInteger('is_satisfied_hospital')->nullable();
            $table->longText('no_better_text')->nullable();
            $table->tinyInteger('is_clear_plan')->nullable();
            $table->longText('improve_suggestion_plan')->nullable();
            $table->tinyInteger('is_finalize_plan')->nullable();
            $table->tinyInteger('is_tech_experience')->nullable();
            $table->longText('specify_text')->nullable();
            $table->tinyInteger('loading_speed_rate')->nullable();
            $table->tinyInteger('is_cost_rate')->nullable();
            $table->longText('service_comment')->nullable();
            $table->tinyInteger('would_contact')->nullable();
            $table->tinyInteger('would_recommend')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->longText('feature_comment')->nullable();

            $table->tinyInteger('tech_rate')->nullable();
            $table->tinyInteger('is_statis_hos_options')->nullable();
            $table->longText('not_satisfy_tech')->nullable();
            $table->tinyInteger('is_clear_estimated')->nullable();
            $table->longText('improve_suggestion_estimated')->nullable();
            $table->tinyInteger('is_final_treat_plan')->nullable();
            $table->tinyInteger('is_exper_tech_issue')->nullable();
            $table->longText('text_specify')->nullable();
            $table->bigInteger('page_load')->nullable();
            $table->bigInteger('is_service_worth_cost')->nullable();
            $table->longText('comment_tech')->nullable();
            $table->longText('feature_wants')->nullable();
            $table->tinyInteger('tech_would_contact')->nullable();
            $table->tinyInteger('is_recommend')->nullable();
            // $table->longText('no_sat_hos_options_text')->nullable();
            // $table->tinyInteger('is_exper_tech')->nullable();
            // $table->longText('yes_text_tech')->nullable();
            // $table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};