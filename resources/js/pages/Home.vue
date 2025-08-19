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
                    @marked-as-favorite="markAsFavorite"
                    @remove-from-favorites="removeFromFavorites"
                    @error="handleError"
                />
            </template>

        </div>

        <Notification
            v-if="notification.isVisible"
            :type="notification.type"
            :message="notification.message"
            @close="notification.isVisible = false"
        />

    </Base>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import Notification from '@/components/Notification.vue';
import Base from '@/layout/Base.vue';
import { Asset } from '@/types';
import { onMounted, ref } from 'vue';
import { listAssets } from '@/service';

const assets = ref<Asset[]>([]);
const isLoading = ref<boolean>(true);
const notification = ref({
    isVisible: false,
    type: '',
    message: '',
});

const loadAssets = async () => {
    try {
        isLoading.value = true;
        const response = await listAssets();
        assets.value = response;
    } catch (error) {
        console.error('Error fetching assets:', error);
        notification.value.isVisible = true;
        notification.value.type = 'error';
        notification.value.message = 'Failed to load assets. Please try again later.';
    } finally {
        isLoading.value = false;
    }
};

const markAsFavorite = (id: string) => {

    notification.value.isVisible = true;
    notification.value.type = 'success';
    notification.value.message = "Marked as favorite successfully!";

    const asset = assets.value.find((asset:Asset) => asset.id === id);
    if (asset) {
        asset.is_favorite = true;
    }
};

const removeFromFavorites = (id: string) => {

    notification.value.isVisible = true;
    notification.value.type = 'success';
    notification.value.message = "Removed from favorites successfully!";

    const asset = assets.value.find((asset:Asset) => asset.id === id);
    if (asset) {
        asset.is_favorite = false;
    }
};

const handleError = (message: string) => {
    notification.value.isVisible = true;
    notification.value.type = 'error';
    notification.value.message = message;
};


onMounted(async () => {
    await loadAssets();
});

</script>
