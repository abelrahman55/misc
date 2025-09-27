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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users','id')->cascadeOnDelete();
            $table->string('date')->nullable();
            $table->string('treatment_type')->nullable();
            $table->string('assigned_coordintor')->nullable();

            $table->string('name'); // اسم المستفسر
            $table->string('contact_details'); // بيانات الاتصال
            $table->unsignedBigInteger('country_id'); // الدولة
            $table->unsignedBigInteger('specialty_id'); // التخصص
            $table->string('proximity'); // القرب / المسافة
            $table->string('reputation'); // السمعة
            $table->double('budget'); // الميزانية
            $table->text('symptoms'); // الأعراض
            $table->unsignedBigInteger('user_id')->nullable(); // لو مربوط بمستخدم
            $table->string('date')->nullable(); // تاريخ الإنشاء


            $table->enum('status', ['pending', 'confirmed','in_progress','awaiting_reply','completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
