<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $data = DB::table('hotel_room_type_room_options')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data hotel & room options berhasil diambil',
            'data' => $data
        ]);
    }

    public function hotel()
    {
        $data = Hotel::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data hotel berhasil diambil',
            'data' => $data
        ]);
    }

    public function CardHotelOnIndex()
    {
        $data = DB::table('v_hotel_detail_review')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data hotel dengan review berhasil diambil',
            'data' => $data
        ]);
    }

    public function ulasan()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data ulasan, rating, user, dan hotel berhasil diambil',
            'data' => DB::table('v_hotel_user_rating_review')->get()
        ]);
    }

    public function searchRoom(Request $request)
    {

        $cabang_hotel = $request->input('kota_tujuan');
        $jumlah_tamu = $request->input('jumlah_tamu', 1);
        $checkIn = $request->input('checkin');
        $checkOut = $request->input('checkout');

        // dd([
        //     'cabang_hotel' => $cabang_hotel,
        //     'jumlah_tamu' => $jumlah_tamu,
        //     'checkin' => $checkIn,
        //     'checkout' => $checkOut
        // ]);

        $data = DB::table('hotel_room_type_room_options AS hrtro')

            // JOIN ke tabel rooms untuk mendapatkan kolom status (karena status ada di tabel rooms)
            ->join('rooms AS r', 'r.id', '=', 'hrtro.room_id')

            // CEK BOOKING YANG BERTUMPUKAN (LEFT JOIN supaya kita tetap dapat rooms tanpa booking)
            ->leftJoin('bookings AS b', function ($join) use ($checkIn, $checkOut) {
                $join->on('b.room_id', '=', 'hrtro.room_id')
                    ->where(function ($query) use ($checkIn, $checkOut) {
                        $query->where('b.check_in', '<', $checkOut)
                            ->where('b.check_out', '>', $checkIn)
                            ->whereIn('b.booking_status', ['pending', 'confirmed']);
                    });
            })

            // HANYA kamar yang tidak bentrok booking
            ->whereNull('b.room_id')

            // HANYA kamar yang statusnya available (dari tabel rooms)
            ->where('r.status', 'available')

            // FILTER CABANG HOTEL / KOTA TUJUAN
            ->when(
                $cabang_hotel,
                fn($q) =>
                $q->where('hrtro.cabang_hotel', 'LIKE', "%{$cabang_hotel}%")
            )

            // FILTER KAPASITAS TAMU
            ->when(
                $jumlah_tamu,
                fn($q) =>
                $q->where('hrtro.max_occupancy', '>=', $jumlah_tamu)
            )

            ->select('hrtro.*')

            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Hasil pencarian kamar berhasil diambil',
            'data' => $data
        ]);


    }

    public function latestRooms()
    {
        $rooms = Room::latest()->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data kamar terbaru berhasil diambil',
            'data' => $rooms
        ]);
    }

    public function stats(){
        $stats = [
            "total_hotels" => Hotel::count(),
            "total_rooms" => Room::count(),
            "total_bookings" => Booking::count(),
            "total_users" => User::count(),
        ];

        return response()->json([
            'status' => 'success',
            'message' => 'Data statistik berhasil diambil',
            'data' => $stats
        ]);
    }
}
