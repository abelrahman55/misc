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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name_coordinator')->nullable();
            $table->string('healthcare_provider')->nullable();
            $table->string('service_inquiry')->nullable();
            $table->date('service_date')->nullable();
            $table->integer('rate')->nullable();
            $table->longText('feedback')->nullable();
            $table->boolean('is_easy')->nullable();
            $table->text('text_no')->nullable();
            $table->integer('design_rate')->nullable();
            $table->boolean('is_clear_feature')->nullable();
            $table->text('improve_suggestion_feature')->nullable();
            $table->integer('medical_rate')->nullable();
            $table->boolean('is_satisfied_hospital')->nullable();
            $table->text('no_better_text')->nullable();
            $table->boolean('is_clear_plan')->nullable();
            $table->text('improve_suggestion_plan')->nullable();
            $table->boolean('is_finalize_plan')->nullable();
            $table->boolean('is_tech_experience')->nullable();
            $table->text('specify_text')->nullable();
            $table->integer('loading_speed_rate')->nullable();
            $table->integer('is_cost_rate')->nullable();
            $table->longText('service_comment')->nullable();
            $table->boolean('would_contact')->nullable();
            $table->boolean('would_recommend')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name_coordinator',
                'healthcare_provider',
                'service_inquiry',
                'service_date',
                'rate',
                'feedback',
                'is_easy',
                'text_no',
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
            ]);
        });
    }
};
