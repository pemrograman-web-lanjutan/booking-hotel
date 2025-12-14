<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_hotel_detail_review');
        DB::statement(<<<SQL
   CREATE VIEW v_hotel_detail_review AS
SELECT
    h.id AS hotel_id,
    h.nama_hotel,
    h.cabang_hotel,
    h.alamat_hotel,

    -- rata-rata rating per hotel (bisa NULL jika belum ada review)
    ROUND(AVG(rev.rating) OVER (PARTITION BY h.id), 1) AS rata_rata_rating,

    -- data ulasan (bisa NULL jika belum ada review)
    rev.id AS review_id,
    rev.judul AS judul_review,
    rev.deskripsi AS deskripsi_review,
    rev.rating AS rating_review,

    -- user (bisa NULL jika belum ada review)
    u.id AS user_id,
    u.name AS user_name

FROM hotels h
LEFT JOIN reviews rev ON rev.hotel_id = h.id
LEFT JOIN users u ON u.id = rev.user_id;
SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_hotel_detail_review');
    }
};