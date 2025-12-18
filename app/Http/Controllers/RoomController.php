<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $rooms = Room::all();

        return response()->json([
            'success' => true,
            'data' => $rooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'id_rooms_type' => 'required|exists:room_types,id',
            'id_hotel' => 'required|exists:hotels,id',
            'room_number' => 'required',
            'status' => 'required|in:available,unavailable,maintenance',
        ]);

        $room = Room::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $request->validate([

            'room_number' => 'required|unique:rooms,room_number',
            'id_rooms_type' => 'required|exists:room_types,id',
            'status' => 'required|in:available,unavailable,maintenance',

        ]);

        $room->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room deleted successfully',
        ]);
    }


    /**
     * Get rooms with hotel and room type information using JOIN
     * Menampilkan: id room, room number, nama hotel, nama tipe kamar, harga
     * 
     * @return JsonResponse
     */
    public function getRoomAndHotel(): JsonResponse
    {
        // CARA 1: Menggunakan Eloquent with() - Paling Mudah & Recommended
        // Ini menggunakan Eager Loading, lebih efisien dan code lebih bersih
        $roomsWithRelations = Room::with(['hotel:id,nama_hotel', 'roomType:id,name,price_per_night'])
            ->select('id', 'room_number', 'id_hotel', 'id_rooms_type')
            ->get()
            ->map(function($room) {
                return [
                    'id' => $room->id,
                    'room_number' => $room->room_number,
                    'hotel_name' => $room->hotel->nama_hotel ?? 'N/A',
                    'room_type' => $room->roomType->name ?? 'N/A',
                    'price' => $room->roomType->price_per_night ?? 0,
                ];
            });

        // CARA 2: Menggunakan Query Builder dengan JOIN - Like SQL
        // Ini menggunakan INNER JOIN seperti SQL biasa
        $roomsJoin = DB::table('rooms')
            ->join('hotels', 'rooms.id_hotel', '=', 'hotels.id')
            ->join('room_types', 'rooms.id_rooms_type', '=', 'room_types.id')
            ->select(
                'rooms.id', 
                'rooms.room_number', 
                'hotels.nama_hotel as hotel_name',
                'room_types.name as room_type_name',
                'room_types.price_per_night as price'
            )
            ->get();

        // CARA 3: Menggunakan Raw Query - Paling Fleksibel
        // Gunakan ini kalau butuh query yang sangat custom
        $roomsRaw = DB::select('
            SELECT 
                rooms.id, 
                rooms.room_number, 
                hotels.nama_hotel as hotel_name,
                room_types.name as room_type_name,
                room_types.price_per_night as price
                room_types.amenities as amenities
                
            FROM rooms
            INNER JOIN hotels ON rooms.id_hotel = hotels.id
            INNER JOIN room_types ON rooms.id_rooms_type = room_types.id
        ');

        // Return salah satu cara (saya pilih cara 2 - Query Builder JOIN)
        return response()->json([
            'success' => true,
            'data' => $roomsJoin,
            'count' => count($roomsJoin),
        ]);

    }
}
