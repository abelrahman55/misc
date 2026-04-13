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
        Schema::create('teleconsultation_meetings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teleconsultation_request_id')->constrained('teleconsultation_requests')->cascadeOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->date('date');
            $table->time('time');
            $table->string('meeting_url')->nullable();
            $table->boolean('ended')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teleconsultation_meetings');
    }
};
