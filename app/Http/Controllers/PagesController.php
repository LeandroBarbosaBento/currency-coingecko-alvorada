<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\CoinGeckoService;

class PagesController extends Controller
{

    public function index()
    {
        return Inertia::render('Home');
    }

    public function listFavorites()
    {
        return Inertia::render('Favorites');
    }

    public function showAsset(string $id)
    {
        return Inertia::render('AssetDetails');
    }

}
