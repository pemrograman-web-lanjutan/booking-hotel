<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer("max_occupancy")->default(1);
            $table->text("amenities")->nullable();
            $table->text('description')->nullable();
            $table->enum('bed_type', ['single', 'double', "twin", "king", "queen"])->default('single');
            $table->decimal('base_price', 10, 2);  // Changed from integer to decimal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_types');
    }
};