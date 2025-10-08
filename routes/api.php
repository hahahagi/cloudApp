<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/register', \App\Http\Controllers\Api\Auth\RegisterController::class);
Route::post('auth/login', \App\Http\Controllers\Api\Auth\LoginController::class);
// Optional info route for GET access to /api/auth/register
Route::get('auth/register', function () {
    return response()->json([
        'message' => 'Use POST to register a new user',
    ]);
});

// Protected route to list users
Route::middleware('auth:sanctum')->get('auth/users', [\App\Http\Controllers\Api\Auth\UserController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/me', [\App\Http\Controllers\Api\Auth\AuthenticatedUserController::class, 'me']);
    Route::post('auth/logout', [\App\Http\Controllers\Api\Auth\AuthenticatedUserController::class, 'logout']);
    Route::post('auth/logout-all', [\App\Http\Controllers\Api\Auth\AuthenticatedUserController::class, 'logoutAll']);
});
