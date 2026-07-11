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
        Schema::create('medical_ratios', function (Blueprint $table) {
            $table->id();
            $table->string('heart_rate')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('temperature')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('oxygen_saturation')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_ratios');
    }
};
