<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use App\Models\Room;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $bookings = Booking::all();

        if($bookings->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No bookings found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $bookings,
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
    public function store(StoreBookingRequest $request):JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'cancellation_date' => 'nullable|date',
        ]);

        $checkIn = Carbon::parse($request->check_in);
        $checkOut = Carbon::parse($request->check_out);
        $totalNights = $checkIn->diffInDays($checkOut);

        $room = Room::with('roomType')->findOrFail($request->room_id);
        $totalAmount = $totalNights * $room->roomType->price_per_night;

        $data = $request->all();
        $data['total_nights'] = $totalNights;
        $data['total_amount'] = $totalAmount;

        $booking = Booking::create($data);

        return response()->json([
            'success' => true,
            'data' => $booking,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking):JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $booking,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return response()->json([
            'success' => true,
            'data' => $booking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking): JsonResponse
    {
        $request->validate([

            'room_id' => 'exists:rooms,id',
            'user_id' => 'exists:users,id',
            'check_in' => 'date',
            'check_out' => 'date|after:check_in',
            'total_amount' => 'integer',
            'booking_status' => 'in:pending,confirmed,canceled,completed',
            'payment_status' => 'in:pending,paid,refunded',

        ]);

        

        $data = $request->all();

        if ($request->has('booking_status')) {
            if ($request->booking_status === 'canceled') {
                $data['cancellation_date'] = now();
            } else {
                $data['cancellation_date'] = null;
            }
        }

        $booking->update($data);

        return response()->json([
            'success' => true,
            'data' => $booking,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking): JsonResponse
    {
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking deleted successfully',
        ]);
    }
}
