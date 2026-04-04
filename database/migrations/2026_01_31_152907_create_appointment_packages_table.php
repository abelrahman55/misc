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
        Schema::create('appointment_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable(); // doctor, hospital, etc.
            $table->json('title');
            $table->float('price');
            $table->enum('status', ['pending', 'approved', 'rejected', 'paid'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('appointment_package_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_package_id');
            $table->unsignedBigInteger('package_option_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_package_items');
        Schema::dropIfExists('appointment_packages');
    }
};
