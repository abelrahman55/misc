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
        if (!Schema::hasTable("booking_provider")) {
        Schema::create('booking_provider', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id')->nullable();
            $table->bigInteger('provider_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('date')->nullable();
            $table->timestamps();
        });}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_provider');
    }
};
