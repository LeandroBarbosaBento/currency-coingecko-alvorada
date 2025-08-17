<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class FavoriteController extends Controller
{

    public function index()
    {
        return Inertia::render('Favorites');
    }

    public function store(Request $request)
    {
        // Logic to store a favorite asset
    }

    public function destroy($id)
    {
        // Logic to remove a favorite asset by ID
    }
}
