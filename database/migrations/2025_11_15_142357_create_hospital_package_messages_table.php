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
        if(Schema::hasTable('hospital_package_messages')) {
            return;
        }
        Schema::create('hospital_package_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_package_id')->nullable();
            $table->string('message')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_package_messages');
    }
};
