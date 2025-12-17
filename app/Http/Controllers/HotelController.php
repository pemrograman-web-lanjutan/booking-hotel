<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'alamat_hotel' => 'required|string',
            'cabang_hotel' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $hotel = Hotel::create($validated);

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
    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);

        $validated = $request->validate([
            'nama_hotel' => 'required|string|max:255',
            'alamat_hotel' => 'required|string',
            'cabang_hotel' => 'required|string|max:255',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        $hotel->update($validated);

        return response()->json([
            'message' => 'Hotel updated successfully',
            'data' => $hotel
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
