<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\CoinGeckoService;
use App\Http\Resources\AssetResource;
use App\Models\Favorite;
use App\Http\Requests\StoreFavoriteRequest;

class AssetController extends Controller
{
    public function __construct(
        private readonly CoinGeckoService $coinGeckoService
    )
    {
    }

    public function index()
    {
        $favoriteIds = Favorite::all()->pluck('asset_id')->toArray();

        $assets = $this->coinGeckoService->getMarketList();

        $assets = collect($assets)->map(function ($asset) use ($favoriteIds) {
                $asset['is_favorite'] = in_array($asset['id'], $favoriteIds);
                return $asset;
            });

        return response()->json(AssetResource::collection($assets));
    }

    public function show(string $id)
    {
        $assetDetails = $this->coinGeckoService->getAssetDetails($id);

        return response()->json($assetDetails);
    }

    public function listFavoriteAssets()
    {
        $favoriteIds = Favorite::all()->pluck('asset_id')->toArray();

        if (empty($favoriteIds)) {
            return response()->json([], 200);
        }

        $assets = $this->coinGeckoService->listFavoriteAssets($favoriteIds);

        $assets = collect($assets)->map(function ($asset) use ($favoriteIds) {
            $asset['is_favorite'] = in_array($asset['id'], $favoriteIds);
            return $asset;
        });

        return response()->json(AssetResource::collection($assets));
    }

    public function markAsFavorite(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::create([
            'asset_id' => $request->asset_id,
        ]);

        return response()->json([
            'message' => 'Favorite added successfully',
            'favorite' => $favorite,
        ], 201);
    }

    public function unmarkAsFavorite($id)
    {
        $favorite = Favorite::where('asset_id', $id)->first();
        $favorite->delete();

        return response()->json([
            'message' => 'Favorite removed successfully',
        ], 200);
    }


}
