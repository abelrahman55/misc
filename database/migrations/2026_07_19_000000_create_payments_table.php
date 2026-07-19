<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_order_id')->unique();
            $table->enum('type', ['package', 'provider', 'nursing']);
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->unsignedInteger('points_used')->default(0);
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->unsignedBigInteger('paymob_order_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
