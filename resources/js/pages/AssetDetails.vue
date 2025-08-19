<template>
    <Base :isLoading="isLoading">
        <div v-if="asset" class="max-w-4xl mx-auto bg-gray-800 rounded-lg shadow-xl overflow-hidden mb-8">
            <div class="p-6 bg-gray-700 flex flex-col sm:flex-row items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img
                        :src="asset.image.large"
                        :alt="asset.name"
                        class="w-16 h-16 rounded-full border-2 border-yellow-400 p-1"
                    />
                    <div>
                        <h1 class="text-3xl font-bold text-yellow-400">
                            {{ asset.name }}
                        </h1>
                        <p class="text-gray-400 text-sm">
                            {{ asset.symbol.toUpperCase() }} | Rank: #{{ asset.market_cap_rank }}
                        </p>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 text-right">
                    <p class="text-2xl font-bold text-green-400">
                        $ {{ formatPrice(asset.market_data.current_price.usd) }}
                    </p>
                    <p
                        class="text-sm"
                        :class="
                            asset.market_data.price_change_percentage_24h > 0
                            ? 'text-green-400'
                            : 'text-red-400'
                        "
                    >
                        {{
                            formatPercentage(asset.market_data.price_change_percentage_24h)
                        }}
                        (24h)
                    </p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-300">
                <div>
                    <h2 class="text-xl font-semibold text-yellow-400 mb-4">
                        Cryptocurrency Details
                    </h2>
                    <div class="space-y-3">
                        <p>
                            <strong class="text-gray-400">Hashing Algorithm:</strong>
                            {{ asset.hashing_algorithm }}
                        </p>
                        <p>
                            <strong class="text-gray-400">Genesis Date:</strong>
                            {{ formatDate(asset.genesis_date) }}
                        </p>
                        <p>
                            <strong class="text-gray-400">Block Time:</strong>
                            {{ asset.block_time_in_minutes }} minutes
                        </p>
                        <p>
                            <strong class="text-gray-400">Categories: </strong>
                            <span
                                v-for="category in asset.categories"
                                :key="category"
                                class="inline-block bg-gray-600 text-gray-200 text-xs px-2 py-1 rounded-full mr-2 mb-2"
                            >
                                {{ category }}
                            </span>
                        </p>

                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-yellow-400 mb-4">
                        Market Data
                    </h2>
                    <div class="space-y-3">
                    <p>
                        <strong class="text-gray-400">Market Cap:</strong>
                        $ {{ formatPrice(asset.market_data.market_cap.usd) }}
                    </p>
                    <p>
                        <strong class="text-gray-400">Total Volume (24h):</strong>
                        $ {{ formatPrice(asset.market_data.total_volume.usd) }}
                    </p>
                    <p>
                        <strong class="text-gray-400">24h High:</strong>
                        <span class="text-green-400"
                        >$ {{ formatPrice(asset.market_data.high_24h.usd) }}</span
                        >
                    </p>
                    <p>
                        <strong class="text-gray-400">24h Low:</strong>
                        <span class="text-red-400"
                        >$ {{ formatPrice(asset.market_data.low_24h.usd) }}</span
                        >
                    </p>
                    <p>
                        <strong class="text-gray-400">All-Time High (ATH):</strong>
                        $ {{ formatPrice(asset.market_data.ath.usd) }}
                        <span class="text-gray-400 text-sm"
                        >({{ formatDate(asset.market_data.ath_date.usd) }})</span
                        >
                    </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <p class="text-gray-400">
                    <strong class="text-gray-400">Description: </strong>
                    <span
                        v-html="asset.description.en"
                        class="text-gray-300 text-sm"
                    ></span>
                </p>

                <div class="mt-4 overflow-y-auto">
                    <CryptoPriceChart
                        :asset-id="asset.id"
                    />
                </div>
            </div>

            <div class="p-6 bg-gray-700 mt-4">
                <h2 class="text-xl font-semibold text-yellow-400 mb-4">Links</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <a
                        v-if="asset.links.homepage[0]"
                        :href="asset.links.homepage[0]"
                        target="_blank"
                        class="text-blue-400 hover:text-blue-200 transition-colors"
                    >
                        Homepage
                    </a>
                    <a
                        v-if="asset.links.whitepaper"
                        :href="asset.links.whitepaper"
                        target="_blank"
                        class="text-blue-400 hover:text-blue-200 transition-colors"
                    >
                        Whitepaper
                    </a>
                    <a
                        v-if="asset.links.blockchain_site[0]"
                        :href="asset.links.blockchain_site[0]"
                        target="_blank"
                        class="text-blue-400 hover:text-blue-200 transition-colors"
                    >
                        Explorer
                    </a>
                    <a
                        v-if="asset.links.subreddit_url"
                        :href="asset.links.subreddit_url"
                        target="_blank"
                        class="text-blue-400 hover:text-blue-200 transition-colors"
                    >
                        Reddit
                    </a>
                    <a
                        v-if="asset.links.repos_url.github[0]"
                        :href="asset.links.repos_url.github[0]"
                        target="_blank"
                        class="text-blue-400 hover:text-blue-200 transition-colors"
                    >
                        GitHub
                    </a>
                </div>
            </div>
        </div>
    </Base>
</template>
<script setup lang="ts">
import { Asset } from '@/types';
import { onMounted, ref } from 'vue';
import { getAssetDetails } from '@/service';
import Base from '@/layout/Base.vue';
import CryptoPriceChart from '@/components/CryptoPriceChart.vue';

const asset = ref<Asset | null>(null);
const isLoading = ref<boolean>(false);

const loadAssetDetails = async () => {

    const assetId = route().params.id;
    try {
        isLoading.value = true;
        asset.value = await getAssetDetails(assetId);
    } catch (error) {
        console.error('Error fetching asset details:', error);
    } finally {
        isLoading.value = false;
    }
};

const formatPrice = (value) => {
  return new Intl.NumberFormat('en-US', {
    style: 'decimal',
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  }).format(value);
};

const formatPercentage = (value) => {
  return value.toFixed(2) + '%';
};

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('pt-BR');
};

onMounted(() => {
    loadAssetDetails()
});

</script>
