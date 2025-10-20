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
        DB::statement('DROP VIEW IF EXISTS v_hotel_user_rating_review');
        
        DB::statement(<<<SQL
            CREATE VIEW v_hotel_user_rating_review AS
            SELECT 
                h.id AS hotel_id,
                h.nama_hotel,
                u.id AS user_id,
                u.name AS user_name,
                rev.id AS review_id,
                rev.judul AS judul_review,
                rev.deskripsi AS deskripsi_review
            FROM hotels h
            JOIN reviews rev ON rev.hotel_id = h.id
            JOIN users u ON rev.user_id = u.id
        SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_hotel_user_rating_review');
    }
};
