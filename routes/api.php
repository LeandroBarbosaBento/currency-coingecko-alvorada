<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'favorites'], function () {
    Route::get('/', [AssetController::class, 'listFavoriteAssets']);
    Route::post('/', [AssetController::class, 'markAsFavorite']);
    Route::delete('/{id}', [AssetController::class, 'unmarkAsFavorite']);
});

Route::group(['prefix' => 'assets'], function () {
    Route::get('/', [AssetController::class, 'index']);
    Route::get('/{id}', [AssetController::class, 'show']);
});
