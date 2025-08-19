<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CoinGeckoService
{
    private const BASE_URL = 'https://api.coingecko.com/api/v3/';
    private const CACHE_TTL = 60; // 60 seconds

    public function getMarketList(): array
    {
        return Cache::remember(
            'coingecko_assets_list',
            self::CACHE_TTL,
            function () {
                $response = Http::baseUrl(self::BASE_URL)->get('coins/markets', [
                    'vs_currency' => 'usd',
                    'order' => 'market_cap_desc',
                    'per_page' => 10,
                    'page' => 1,
                ]);
                return $response->json();
        });
    }

    public function listFavoriteAssets(array $favoriteIds): array
    {
        $response = Http::baseUrl(self::BASE_URL)->get('coins/markets', [
            'vs_currency' => 'usd',
            'order' => 'market_cap_desc',
            'per_page' => 10,
            'page' => 1,
            'ids' => implode(',', $favoriteIds),
        ]);
        return $response->json();
    }

    public function getAssetDetails(string $id): array
    {
        return Cache::remember("coingecko_asset_{$id}", self::CACHE_TTL, function () use ($id) {
            $response = Http::baseUrl(self::BASE_URL)->get("coins/{$id}");
            return $response->json();
        });
    }

}
