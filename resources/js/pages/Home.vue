<template>
    <Base>
        <h2 class="text-2xl sm:text-3xl font-bold mb-8 sm:mb-16">
            Featured Cryptocurrencies
        </h2>
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
    </Base>
</template>
<script setup lang="ts">
import CryptoCurrencyCard from '@/components/CryptoCurrencyCard.vue';
import Base from '@/layout/Base.vue';
</script>
