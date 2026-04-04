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
        Schema::create('appointment_package_manual_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_package_id');
            $table->string('title');
            $table->timestamps();

            $table->foreign('appointment_package_id', 'ap_manual_item_foreign')
                ->references('id')
                ->on('appointment_packages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_package_manual_items');
    }
};
