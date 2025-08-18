<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AssetController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'favorites'], function () {
    Route::get('/', [FavoriteController::class, 'index']);
    Route::post('/', [FavoriteController::class, 'store']);
    Route::delete('/{id}', [FavoriteController::class, 'destroy']);
});

Route::group(['prefix' => 'assets'], function () {
    Route::get('/', [AssetController::class, 'index']);
    Route::get('/{id}', [AssetController::class, 'show']);
});
