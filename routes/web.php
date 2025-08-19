<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PagesController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/', [PagesController::class, 'index'])->name('assets.index');
Route::get('/assets/{id}', [PagesController::class, 'showAsset'])->name('assets.show');
Route::get('/favorites',[PagesController::class, 'listFavorites'])->name('favorites.index');
