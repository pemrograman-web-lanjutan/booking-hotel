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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->integer("hotel_id")->foreign()->references('id')->on('hotels')->onDelete('cascade');
            $table->string("judul", 50);
            $table->text("deskripsi");
            $table->integer("rating");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
