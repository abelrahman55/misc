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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('commun_method')->nullable();
            $table->bigInteger('country_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('treatment_service_id')->nullable();
            $table->string('appoint_date')->nullable();
            $table->string('appoint_time')->nullable();
            $table->string('urgence_level')->nullable();
            $table->bigInteger('doctor_id')->nullable();
            $table->enum('status',['pending','completed','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
