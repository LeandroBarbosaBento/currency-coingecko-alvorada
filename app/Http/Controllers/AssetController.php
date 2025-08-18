<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\CoinGeckoService;

class AssetController extends Controller
{
    public function __construct(
        private readonly CoinGeckoService $coinGeckoService
    )
    {
    }

    public function index()
    {
        $assets = $this->coinGeckoService->getMarketList();

        return response()->json($assets);
    }

    public function show(string $id)
    {
        $assetDetails = $this->coinGeckoService->getAssetDetails($id);

        if (empty($assetDetails)) {
            abort(404);
        }

        return response()->json($assetDetails);
    }


}
