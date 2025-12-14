<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorereviewsRequest;
use App\Http\Requests\UpdatereviewsRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'hotel_id' => 'required|integer|exists:hotels,id',
            // 'hotel_id' => 'nullable|integer',    
            'rating' => 'required|integer|min:1|max:5',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:1000',
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'hotel_id' => $validatedData['hotel_id'] ?? 0,
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

    public function reviewsByHotel($id)
    {
        $reviews = \DB::table('v_hotel_user_rating_review')
            ->where('hotel_id', $id)
            ->whereNotNull('review_id')
            ->orderBy('review_id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $reviews
        ]);
    }

    public function showReviewsByHotel($hotelId)
    {
        $reviews = Review::where('hotel_id', $hotelId)->get();

        return response()->json([
            'success' => true,
            'data' => $reviews,
        ]);
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
