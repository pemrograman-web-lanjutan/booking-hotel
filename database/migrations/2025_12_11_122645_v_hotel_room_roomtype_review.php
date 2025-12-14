<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_hotel_review');

        DB::statement(<<<SQL
CREATE VIEW v_hotel_review AS
SELECT
    h.id AS hotel_id,
    h.nama_hotel,
    h.cabang_hotel,
    h.alamat_hotel,

    rev.id AS review_id,
    rev.user_id,
    rev.judul,
    rev.deskripsi,
    rev.rating,
    rev.created_at
FROM hotels h
LEFT JOIN reviews rev ON rev.hotel_id = h.id;
SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_hotel_review');
    }
};
