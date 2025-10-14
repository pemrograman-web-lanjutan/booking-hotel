<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
