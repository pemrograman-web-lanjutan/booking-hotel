<?php

namespace App\Http\Controllers;

use App\Models\Media_room;
use App\Http\Requests\StoreMedia_roomRequest;
use App\Http\Requests\UpdateMedia_roomRequest;

class MediaRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media_rooms = Media_room::all();

        return response()->json([
            'success' => true,
            'data' => $media_rooms,
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
    public function store(StoreMedia_roomRequest $request)
    {
        $request->validate([
            'room_id' => 'required|integer|exists:rooms,id',
            'image_url' => 'required|string|max:255',
            'image_name' => 'required|string|max:100',
        ]);

        $media_room = Media_room::create($request->all());
        return response()->json([
            'success' => true,
            'data' => $media_room,
        ], 201);    
    }

    /**
     * Display the specified resource.
     */
    public function show(Media_room $media_room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media_room $media_room)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedia_roomRequest $request, Media_room $media_room)
    {
        $request->validate([
            'room_id' => 'required|integer|exists:rooms,id',
            'image_url' => 'required|string|max:255',
            'image_name' => 'required|string|max:100',
        ]);

        $media_room->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $media_room,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media_room $media_room)
    {
        $media_room->delete();

        return response()->json([
            'success' => true,
            'message' => 'Media room deleted successfully',
        ]);
    }
}
