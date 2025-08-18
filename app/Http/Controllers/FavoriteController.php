<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreFavoriteRequest;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::create([
            'asset_id' => $request->asset_id,
        ]);

        return response()->json([
            'message' => 'Favorite added successfully',
            'favorite' => $favorite,
        ], 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('asset_id', $id)->first();
        $favorite->delete();

        return response()->json([
            'message' => 'Favorite removed successfully',
        ], 200);
    }
}
