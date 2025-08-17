<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/favorites', [FavoriteController::class, 'store']);
Route::get('/favorites', [FavoriteController::class, 'index']);
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
