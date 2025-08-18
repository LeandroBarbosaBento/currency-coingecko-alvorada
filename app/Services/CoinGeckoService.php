<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CoinGeckoService
{
    private const BASE_URL = 'https://api.coingecko.com/api/v3/';
    private const CACHE_TTL = 60; // 60 seconds

    public function getMarketList(array $ids = []): array
    {
        $query = [
            'vs_currency' => 'usd',
            'order' => 'market_cap_desc',
            'per_page' => 10,
            'page' => 1,
        ];
        if(!empty($ids)) {
            $query['ids'] = implode(',', $ids);
        }
        return Cache::remember(
            'coingecko_assets_list',
            self::CACHE_TTL,
            function () use ($query) {
                $response = Http::baseUrl(self::BASE_URL)->get('coins/markets', $query);
                return $response->json();
        });
    }

    public function getAssetDetails(string $id): array
    {
        return Cache::remember("coingecko_asset_{$id}", self::CACHE_TTL, function () use ($id) {
            $response = Http::baseUrl(self::BASE_URL)->get("coins/{$id}");
            return $response->json();
        });
    }

}
