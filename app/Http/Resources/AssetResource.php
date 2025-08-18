<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'id' => $this['id'],
            'name' => $this['name'],
            'symbol' => $this['symbol'],
            'image' => $this['image'],
            'current_price' => $this['current_price'],
            'market_cap' => $this['market_cap'],
            'market_cap_rank' => $this['market_cap_rank'],
            'fully_diluted_valuation' => $this['fully_diluted_valuation'] ?? null,
            'total_volume' => $this['total_volume'],
            'high_24h' => $this['high_24h'],
            'low_24h' => $this['low_24h'],
            'price_change_24h' => $this['price_change_24h'],
            'price_change_percentage_24h' => $this['price_change_percentage_24h'],
            'market_cap_change_24h' => $this['market_cap_change_24h'],
            'market_cap_change_percentage_24h' => $this['market_cap_change_percentage_24h'],
            'circulating_supply' => $this['circulating_supply'],
            'total_supply' => $this['total_supply'] ?? null,
            'max_supply' => $this['max_supply'] ?? null,
            'ath' => $this['ath'],
            'ath_change_percentage' => $this['ath_change_percentage'],
            'ath_date' => $this['ath_date'],
            'atl' => $this['atl'],
            'atl_change_percentage' => $this['atl_change_percentage'],
            'atl_date' => $this['atl_date'],
            'roi' => $this['roi'] ?? [
                'times' => null,
                'currency' => null,
                'percentage' => null,
            ],
            'last_updated' => $this['last_updated'],
            'is_favorite' => $this['is_favorite'] ?? false,
        ];
    }
}
