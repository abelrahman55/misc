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
        Schema::create('package_make_meeting', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('doctor_id');
            $table->string('meeting')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->tinyInteger('ended')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_make_meeting');
    }
};
