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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('full_name')->nullable();
            $table->string('m_name')->nullable();
            $table->string('home_number')->nullable();
            $table->string('l_name');
            $table->string('relationship')->nullable();
            $table->string('phone')->unique();
            $table->string('allergies')->nullable();
            $table->string('medications')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('dnr')->nullable(); // Do Not Resuscitate
            $table->string('organ_donation')->nullable();
            $table->string('p_f_name')->nullable(); // primary care provider's name
            $table->string('p_m_name')->nullable(); // primary care provider's middle name
            $table->string('p_l_name')->nullable(); // primary care provider's last name
            $table->string('p_phone')->nullable(); // primary care provider's phone number
            $table->string('p_email')->nullable(); // primary care provider's email
            $table->string('p_home')->nullable(); // primary care provider's address
            $table->string('chro_ill_conditions')->nullable(); // chronic illnesses
            $table->string('surgical_history')->nullable();//Surgical History
            $table->string('family_history')->nullable(); // Family History
            // $table->string('immunizations')->nullable();//Immunizations and vaccinations
            $table->tinyInteger('smoking')->default(0); // 0 for no, 1 for yes
            $table->tinyInteger('alcohol')->default(0); // 0 for no, 1 for yes
            $table->tinyInteger('physical_activity')->default(0); //Physical activity
            $table->string('dietary_preferences')->nullable(); // Dietary preferences
            $table->string('heart_rate')->nullable(); // Heart rate
            $table->string('blood_pressure')->nullable(); // Blood pressure
            $table->string('temperature')->nullable(); // Body temperature
            $table->string('respiratory_rate')->nullable(); // Respiratory rate
            $table->string('oxygen_saturation')->nullable(); // Oxygen saturation
            $table->string('height')->nullable(); // Height
            $table->string('weight')->nullable(); // Weight
            $table->string('waist_circumference')->nullable(); // Waist circumference
            $table->string('prefered_hospital')->nullable();
            $table->string('prefered_clinic')->nullable();
            $table->string('prefered_specialist')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('code')->nullable();
            $table->enum('role',['patient', 'doctor', 'admin'])->default('patient'); // Default role is 'user'
            $table->enum('gender',['male','female'])->nullable();
            $table->string('street_name')->nullable();
            $table->string('town')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('ban')->default(0);
            $table->string('country')->nullable();
            $table->enum('military_status', ['active', 'inactive', 'veteran'])->default('inactive');
            $table->string('occupation')->nullable();
            $table->string('age')->nullable();
            $table->string('dob')->nullable();
            $table->string('prof_img')->nullable();
            $table->string('about')->nullable();
            $table->string('pronous')->nullable();
            $table->string('qualification')->nullable();
            $table->tinyInteger('specialization_id')->nullable();
            $table->string('experience')->nullable();
            $table->string('complaints')->nullable();
            $table->string('doctor_date')->nullable();
            $table->string('doctor_time')->nullable();
            $table->string('age_group')->nullable();
            $table->string('language')->default('arabic');
            $table->timestamps();
        });
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
