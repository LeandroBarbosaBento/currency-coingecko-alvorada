<template>
    <Base :isLoading="isLoading">
        <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-16">
            Featured Cryptocurrencies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <template v-if="assets.length === 0">
                <p>No assets available.</p>
            </template>
            <template v-else>
                <CryptoCurrencyCard
                    v-for="asset in assets"
                    :key="asset.id"
                    :id="asset.id"
                    :name="asset.name"
                    :symbol="asset.symbol"
                    :image="asset.image"
                    :price="asset.current_price"
                    :priceChange="asset.price_change_percentage_24h"
                    :volume="asset.total_volume"
                    :isFavorite="asset.is_favorite"
                    @mark-favorite="markAsFavorite"
                    @remove-favorite="removeFromFavorites"
                />
            </template>

        </div>
    </Base>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import Base from '@/layout/Base.vue';
import { Asset } from '@/types';
import { onMounted, ref } from 'vue';
import {
    listAssets,
    markAssetAsFavorite,
    unmarkAssetAsFavorite
} from '@/service';

const assets = ref<Asset[]>([]);
const isLoading = ref<boolean>(true);

const loadAssets = async () => {
    try {
        isLoading.value = true;
        const response = await listAssets();
        assets.value = response;
    } catch (error) {
        console.error('Error fetching assets:', error);
    } finally {
        isLoading.value = false;
    }
};

const markAsFavorite = async (id: string) => {
    try {
        await markAssetAsFavorite(id);
    } catch (error) {
        console.error('Error removing favorite:', error);
    }
};

const removeFromFavorites = async (id: string) => {
    try {
        await unmarkAssetAsFavorite(id);
    } catch (error) {
        console.error('Error removing favorite:', error);
    }
};

onMounted(async () => {
    await loadAssets();
});

</script>
