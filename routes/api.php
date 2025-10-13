<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MediaRoomController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\PaymentController;


Route::middleware('api')->group(function () {

    Route::prefix("booking")->group(function () {
        Route::apiResource('bookings', BookingController::class);
    });

    Route::prefix("hotel")->group(function () {
        Route::apiResource('hotels', HotelController::class);
    });

    Route::prefix('media-rooms')->group(function () {
        Route::apiResource('media-rooms', MediaRoomController::class);
    });

    Route::prefix('payments')->group(function () {
        Route::apiResource('payments', PaymentController::class);
    });

    Route::prefix('ratings')->group(function () {
        Route::apiResource('ratings', RatingController::class);
    });

    Route::prefix('reviews')->group(function () {
        Route::apiResource('reviews', ReviewController::class);
    });

    Route::prefix('rooms')->group(function () {
        Route::apiResource('rooms', RoomController::class);
    });

    Route::prefix('room-types')->group(function () {
        Route::apiResource('room-types', RoomTypeController::class);
    });

    Route::prefix('users')->group(function () {
        Route::apiResource('users', UserController::class);
    });

});

Route::get("/hello", function() {
    return response()->json([
        'message' => 'Hello, World!'
    ]);
});