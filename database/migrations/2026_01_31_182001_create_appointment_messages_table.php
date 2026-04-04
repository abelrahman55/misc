<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_conversation_id')->constrained('appointment_conversations')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->text('message')->nullable();
            $table->string('voice')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_messages');
    }
};
