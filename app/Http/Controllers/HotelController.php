<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Hotel::all(),
        ]);
    }

    public function roomsByHotel(int $hotelId): JsonResponse
    {

        $data = DB::table('v_rooms_detail')
            ->where('id_hotel', $hotelId)
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data rooms berhasil diambil',
            'data' => $data
        ]);
    }

    public function showRoomDetail(int $roomId): JsonResponse
    {
        // Menggunakan view/tabel yang sama dengan roomsByHotel
        $room = DB::table('v_rooms_detail')
            ->where('id', $roomId) // Filter berdasarkan ID kamar
            ->first(); // Ambil hanya satu hasil

        if (!$room) {
            return response()->json([
                'status' => 'error',
                'message' => 'Detail kamar tidak ditemukan.',
                'data' => null
            ], 404); // Mengembalikan status 404 jika data tidak ada
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail kamar berhasil diambil',
            'data' => $room
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:100|unique:hotels',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $hotel = Hotel::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $hotel,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $hotel,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $hotel,
        ]);
    }

    //


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|string|email|max:100|unique:hotels,email,' . $hotel->id,
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $hotel->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $hotel,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hotel deleted successfully',
        ]);
    }
}
