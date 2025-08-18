import { Asset } from "@/types";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000';

export const listAssets = async (): Promise<Asset[]> => {
    const response = await fetch(`${API_BASE_URL}/api/assets`);
    if (!response.ok) {
        throw new Error('Failed to fetch assets');
    }
    return response.json();
}
