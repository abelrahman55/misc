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
        Schema::create('related_package_hospital_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_hospital_option_id')->nullable();
            $table->bigInteger('package_hospital_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_package_hospital_options');
    }
};
