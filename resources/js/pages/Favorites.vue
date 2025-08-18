<template>
    <Base :isLoading="isLoading">
        <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-16">
            Favorited Cryptocurrencies
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <CryptoCurrencyCard
                v-for="i in 3"
                :key="i"
                :id="`${i}`"
                name="Bitcoin"
                symbol="BTC"
                image="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1696501400"
                :price="67500.00"
                :priceChange="3.5"
                :volume="300000000"
            />
        </div>
    </Base>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import { Head, Link } from '@inertiajs/vue3';
import Base from '@/layout/Base.vue';
import { ref, onMounted } from 'vue';

const isLoading = ref<boolean>(true);

onMounted(() => {
    setTimeout(() => {
        isLoading.value = false; // Simulate loading delay
    }, 1000);
});
</script>
