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
        DB::statement('DROP VIEW IF EXISTS v_rooms_detail');
        ;
        DB::statement(<<<SQL
         CREATE VIEW v_rooms_detail AS
            SELECT 
                r.id,
                r.room_number,
                r.status,
                r.id_hotel,
                r.created_at,
                r.updated_at,
                rt.id as room_type_id,
                rt.name as room_type_name,
                rt.max_occupancy,
                rt.amenities,
                rt.description,
                rt.bed_type,
                rt.price_per_night
            FROM rooms r
            INNER JOIN room_types rt ON r.id_rooms_type = rt.id
        
    SQL);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
