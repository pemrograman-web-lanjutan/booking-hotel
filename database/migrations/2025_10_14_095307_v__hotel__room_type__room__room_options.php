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
        DB::statement('DROP VIEW IF EXISTS hotel_room_type_room_options');
        DB::statement(<<<SQL
            CREATE VIEW hotel_room_type_room_options AS
            SELECT
                h.id AS hotel_id,
                h.nama_hotel,
                h.cabang_hotel,
                h.alamat_hotel,
                rt.id AS room_type_id,
                rt.max_occupancy AS max_occupancy,
                rt.price_per_night AS price_per_night, 
                rt.amenities,
                r.id AS room_id,
                r.room_number
            FROM hotels AS h
            JOIN rooms AS r ON r.id_hotel = h.id
            JOIN room_types AS rt ON r.id_rooms_type = rt.id
            GROUP BY 
                h.id, 
                h.nama_hotel, 
                h.cabang_hotel, 
                h.alamat_hotel,
                rt.id, 
                rt.max_occupancy,
                rt.amenities,
                r.id, 
                r.room_number;
        SQL
        );

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS hotel_room_type_room_options');
    }
};
