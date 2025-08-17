<template>
    <div
        class="w-full sm:max-w-sm md:max-w-lg bg-gray-800 p-4 sm:p-6 rounded-2xl shadow-2xl text-white transform transition duration-500 hover:scale-105"
    >
        <div class="flex items-center space-x-3 sm:space-x-4">
            <img
                src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1696501400"
                alt="Bitcoin Logo"
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full shadow-lg"
            />
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">
                    {{ name }}
                </h2>
                <p class="text-gray-400 text-base sm:text-lg">
                    {{ symbol }}
                </p>
            </div>
        </div>

        <div class="mt-4 sm:mt-6 flex flex-col items-start">
            <p class="text-gray-400 text-base sm:text-lg">Current Price</p>
            <div class="flex flex-wrap items-baseline mt-1 gap-x-2 gap-y-1">
                <p class="text-2xl sm:text-3xl md:text-5xl font-extrabold text-green-400">
                    $67,500.00
                </p>
                <span class="flex items-center text-green-400 text-sm sm:text-base md:text-lg font-semibold">
                    <svg
                    class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-1"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 9.707a1 1 0 010-1.414L10 3.586l4.707 4.707a1 1 0 01-1.414 1.414L11 6.414V16a1 1 0 11-2 0V6.414l-2.293 2.293a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                    ></path>
                    </svg>
                    {{ priceChange }}
                </span>
            </div>
        </div>
        <div
            class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4 sm:mt-6 border-t border-gray-700 pt-4 sm:pt-6"
        >
            <div>
                <p class="text-gray-400 text-xs sm:text-sm">Market Cap</p>
                <p class="text-base sm:text-lg font-bold mt-1">
                    $1.3 Trillion
                </p>
            </div>
            <div>
                <p class="text-gray-400 text-xs sm:text-sm">Volume (24h)</p>
                <p class="text-base sm:text-lg font-bold mt-1">
                    $30 Billion
                </p>
            </div>
        </div>

        <button
            class="w-full mt-4 sm:mt-6 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 sm:py-3 rounded-lg shadow-md transition duration-300 cursor-pointer"
        >
            Favorite
        </button>
    </div>
</template>
<script setup lang="ts">
import { defineProps } from 'vue';
const props = defineProps({
    name: {
        type: String,
        default: 'Bitcoin'
    },
    symbol: {
        type: String,
        default: 'BTC'
    },
    image: {
        type: String,
        default: 'https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1696501400'
    },
    price: {
        type: String,
        default: '$67,500.00'
    },
    priceChange: {
        type: String,
        default: '3.5%'
    },
    marketCap: {
        type: String,
        default: '$1.3 Trillion'
    },
    volume: {
        type: String,
        default: '$30 Billion'
    }
});
</script>
