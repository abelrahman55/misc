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
        Schema::create('user_surgicals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('current_treatment')->nullable();
            $table->string('start_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('past_procedures')->nullable();
            $table->string('surg_date')->nullable();
            $table->string('surgeon')->nullable();
            $table->string('outcomes')->nullable();
            $table->string('reason_for_referral')->nullable();
            $table->string('recommendation')->nullable();
            $table->string('file_surgery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_surgicals');
    }
};