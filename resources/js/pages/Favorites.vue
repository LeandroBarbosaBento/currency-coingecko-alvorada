<template>
    <Base :isLoading="isLoading">
        <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-16">
            Favorited Cryptocurrencies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <template v-if="favoriteAssets.length === 0">
                <p>No assets available.</p>
            </template>
            <template v-else>
                <CryptoCurrencyCard
                    v-for="asset in favoriteAssets"
                    :key="asset.id"
                    :id="asset.id"
                    :name="asset.name"
                    :symbol="asset.symbol"
                    :image="asset.image"
                    :price="asset.current_price"
                    :priceChange="asset.price_change_percentage_24h"
                    :volume="asset.total_volume"
                    :isFavorite="asset.is_favorite"
                    @remove-from-favorites="removeFromFavorites"
                />
            </template>
        </div>
    </Base>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import { Head, Link } from '@inertiajs/vue3';
import Base from '@/layout/Base.vue';
import { ref, onMounted } from 'vue';
import { Asset } from '@/types';
import { listFavoriteAssets } from '@/service';

const isLoading = ref<boolean>(true);

const favoriteAssets = ref<Asset[]>([]);

const loadFavorites = async () => {
    try {
        isLoading.value = true;
        const response = await listFavoriteAssets();
        favoriteAssets.value = response;
    } catch (error) {
        console.error('Error fetching favorite assets:', error);
    } finally {
        isLoading.value = false;
    }
};

const removeFromFavorites = (id: string) => {
    const index = favoriteAssets.value.findIndex((asset:Asset)=> asset.id === id);
    if (index !== -1) {
        favoriteAssets.value.splice(index, 1);
    }
};

onMounted(async () => {
    await loadFavorites();
});
</script>
