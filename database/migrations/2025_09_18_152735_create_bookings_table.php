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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade')->references('id')->on('rooms');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->references('id')->on('users');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer("total_amount");
            $table->enum('booking_status', ["pending", "confirmed", "canceled", "completed"])->default('pending');
            $table->enum('payment_status', ["pending", "paid", "refunded"])->default('pending');
            $table->timestamp('booking_date')->useCurrent();
            $table->timestamp('cancellation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
