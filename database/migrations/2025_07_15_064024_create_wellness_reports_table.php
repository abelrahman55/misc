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
        if(Schema::hasTable("wellness_reports")){
            return ;
        }
        Schema::create('wellness_reports', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->json('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wellness_reports');
    }
};
