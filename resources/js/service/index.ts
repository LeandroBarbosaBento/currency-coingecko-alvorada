import { Asset } from "@/types";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://127.0.0.1:8000';

export const listAssets = async (): Promise<Asset[]> => {
    const response = await fetch(`${API_BASE_URL}/api/assets`);
    if (!response.ok) {
        throw new Error('Failed to fetch assets');
    }
    return response.json();
}

export const markAssetAsFavorite = async (assetId: string): Promise<void> => {
    const response = await fetch(`${API_BASE_URL}/api/favorites`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json",
        },
        credentials: "include",
        body: JSON.stringify({ asset_id: assetId }),
    });

    if (!response.ok) {
        throw new Error('Failed to mark asset as favorite');
    }
}

export const unmarkAssetAsFavorite = async (assetId: string): Promise<void> => {
    const response = await fetch(`/api/favorites/${assetId}`, {
        method: 'DELETE',
    });

    if (!response.ok) {
        throw new Error('Failed to unmark asset');
    }
}

export const listFavoriteAssets = async (): Promise<Asset[]> => {
    const response = await fetch(`${API_BASE_URL}/api/favorites`);
    if (!response.ok) {
        throw new Error('Failed to fetch favorite assets');
    }
    return response.json();
}
