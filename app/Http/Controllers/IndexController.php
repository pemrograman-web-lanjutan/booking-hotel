<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hotel;

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

    public function hotel() {

        $data = Hotel::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Data hotel berhasil diambil',
            'data' => $data
        ]);
    }

    public function ulasan(){
        DB::table('v_hotel_user_rating_review')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data ulasan, rating, user, dan hotel berhasil diambil',
            'data' => DB::table('v_hotel_user_rating_review')->get()
        ]);
    }
}
