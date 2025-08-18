<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\CoinGeckoService;
use App\Http\Resources\AssetResource;
use App\Models\Favorite;

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

        $assetDetails = new AssetResource($assetDetails);

        return response()->json($assetDetails);
    }


}
