<?php

use Illuminate\Support\Facades\Route;
use App\Application\Http\Controllers\BookController;
use App\Application\Http\Controllers\StoreController;
use App\Application\Http\Controllers\AuthController;

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Book routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{isbn}', [BookController::class, 'update']);
    Route::delete('/books/{isbn}', [BookController::class, 'destroy']);
});

// Store routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/stores', [StoreController::class, 'index']);
    Route::post('/stores', [StoreController::class, 'store']);
    Route::put('/stores/{id}', [StoreController::class, 'update']);
    Route::delete('/stores/{id}', [StoreController::class, 'destroy']);
});

// StoreBook routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/stores/{store_id}/books/{isbn}', [StoreController::class, 'addBook']);
    Route::delete('/stores/{store_id}/books/{isbn}', [StoreController::class, 'removeBook']);
});
