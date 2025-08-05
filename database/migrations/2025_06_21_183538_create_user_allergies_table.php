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
        Schema::create('user_allergies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('specific_drug')->nullable();
            $table->string('reaction_details')->nullable();
            $table->string('infor_environment')->nullable();
            $table->string('specific_food')->nullable();
            $table->string('insur_address')->nullable();
            $table->string('insur_policy')->nullable();
            $table->string('insur_coverage')->nullable();
            $table->string('bill_street_name')->nullable();
            $table->string('bill_town')->nullable();
            $table->string('bill_number')->nullable();
            $table->string('preferred_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_allergies');
    }
};