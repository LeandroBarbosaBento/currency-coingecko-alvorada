<template>
    <div>
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-white text-2xl font-bold">Crypto Dashboard</h1>
                <div>
                    <Link href="/" class="text-white hover:text-gray-300">Home</Link>
                    <Link href="/welcome" class="ml-4 text-white hover:text-gray-300">Favorites</Link>
                </div>
            </div>
        </nav>
        <div class="container mx-auto px-2 mt-4 sm:mt-9">
            <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-16">Featured Cryptocurrencies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <CryptoCurrencyCard
                    v-for="i in 10"
                    :key="i"
                    name="Bitcoin"
                    symbol="BTC"
                    image="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1696501400"
                    price="$67,500.00"
                    priceChange="3.5%"
                    marketCap="$1.3 Trillion"
                    volume="$30 Billion"
                />
            </div>
        </div>

    </div>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
