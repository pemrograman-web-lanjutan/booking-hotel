<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::prefix('users')->group(function () {
        Route::apiResource('users', UserController::class);
    });

    Route::prefix('room-types')->group(function () {
        Route::apiResource('room-types', RoomTypeController::class);
    });

    Route::prefix('rooms')->group(function () {
        Route::apiResource('rooms', RoomController::class);
    });
});

Route::get("/hello", function() {
    return response()->json([
        'message' => 'Hello, World!'
    ]);
});