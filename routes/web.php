<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/', [AssetController::class, 'index'])->name('assets.index');
Route::get('/assets/{id}', [AssetController::class, 'show'])->name('assets.show');
Route::get('/favorites',[FavoriteController::class, 'index'])->name('favorites.index');
