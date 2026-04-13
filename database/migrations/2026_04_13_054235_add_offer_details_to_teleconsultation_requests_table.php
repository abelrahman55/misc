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
        Schema::table('teleconsultation_requests', function (Blueprint $table) {
            $table->text('offer_details')->nullable()->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teleconsultation_requests', function (Blueprint $table) {
            $table->dropColumn('offer_details');
        });
    }
};
