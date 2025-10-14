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
        DB::statement(<<<SQL
CREATE VIEW hotel_room_type_room_options AS
SELECT
    h.id AS hotel_id,
    h.nama_hotel,
    rt.id AS room_type_id,
    rt.name AS room_type_name,
    r.id AS room_id,
    r.room_number,
    GROUP_CONCAT(
        CONCAT(
            'Breakfast: ',
            CASE WHEN o.is_include_breakfast THEN 'Yes' ELSE 'No' END,
            ', Base Price: ', o.base_price
        )
        SEPARATOR '; '
    ) AS room_options
FROM hotels AS h
JOIN rooms AS r ON r.id_hotel = h.id
JOIN room_types AS rt ON r.id_rooms_type = rt.id
LEFT JOIN room_options AS o ON o.room_id = r.id
GROUP BY h.id, h.nama_hotel, rt.id, rt.name, r.id, r.room_number;
SQL
        );


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS hotel_room_type_room_options;');
    }
};
