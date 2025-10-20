<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Http\Requests\StorereviewsRequest;
use App\Http\Requests\UpdatereviewsRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Review::all(),
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
    public function store(StorereviewsRequest $request)
    {
        $validatedData = $request->validate([
            'hotel_id' => 'required|integer|exists:hotels,id',
            'rating' => 'required|integer|min:1|max:5',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'hotel_id' => $validatedData['hotel_id'],
            'rating' => $validatedData['rating'],
            'judul' => $validatedData['judul'],
            'deskripsi' => $validatedData['deskripsi'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review berhasil dibuat',
            'data' => $review
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $review,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Review deleted successfully',
        ]);
    }
}
