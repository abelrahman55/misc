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
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'notes')) {
                $table->text('notes')->nullable();
            }
            if (!Schema::hasColumn('appointments', 'specialty_id')) {
                $table->unsignedBigInteger('specialty_id')->nullable();
            }
        });

        Schema::table('treatment_services', function (Blueprint $table) {
            if (!Schema::hasColumn('treatment_services', 'specialty_id')) {
                $table->unsignedBigInteger('specialty_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['notes', 'specialty_id']);
        });

        Schema::table('treatment_services', function (Blueprint $table) {
            $table->dropColumn(['specialty_id']);
        });
    }
};
