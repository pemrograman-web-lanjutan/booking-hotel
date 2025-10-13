<?php

namespace App\Http\Controllers;

use App\Models\Room_type;
use App\Http\Requests\StoreRoom_typeRequest;
use App\Http\Requests\UpdateRoom_typeRequest;
use Illuminate\Http\JsonResponse;
class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $room_types = Room_type::all();

        return response()->json([
            'success' => true,
            'data' => $room_types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        $request->validate([

            'name' => 'required|string|max:100|unique:room_types',
            'description' => 'string',
            'base_price' => 'required|integer|min:0',

        ]);

        $room_type = Room_type::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $room_type,
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoom_typeRequest $request): JsonResponse
    {
        $request->validate([

            'name' => 'required|string|max:100|unique:room_types',
            'description' => 'string',
            'base_price' => 'required|integer|min:0',

        ]);

        $room_type = Room_type::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $room_type,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room_type $room_type): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $room_type,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room_type $room_type): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $room_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoom_typeRequest $request, Room_type $room_type): JsonResponse
    {
        $room_type->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $room_type,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room_type $room_type): JsonResponse
    {
        $room_type->delete();

        return response()->json([
            'success' => true,
            'message' => 'Room type deleted successfully',
        ]);
    }
}
