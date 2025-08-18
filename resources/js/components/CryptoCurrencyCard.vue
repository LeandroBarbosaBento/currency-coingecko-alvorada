<template>
    <div
        class="w-full sm:max-w-sm md:max-w-lg bg-gray-800 p-4 sm:p-6 rounded-2xl shadow-2xl text-white transform transition duration-500 hover:scale-105 flex flex-col justify-between"
    >
        <div class="flex items-center space-x-3 sm:space-x-4">
            <img
                :src="image"
                alt="Logo"
                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full shadow-lg"
            />
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold">
                    {{ name }}
                </h2>
                <p class="text-gray-400 text-base sm:text-lg">
                    {{ symbol?.toUpperCase() }}
                </p>
            </div>
        </div>

        <div class="mt-4 sm:mt-6 flex flex-col items-start">
            <p class="text-gray-400 text-base sm:text-lg">Current Price</p>
            <div class="flex flex-col mt-1 gap-x-2 gap-y-1">
                <p
                    class="text-xl sm:text-3xl md:text-5xl font-extrabold text-green-400"
                    :class="{
                        'text-green-400': priceChange >= 0,
                        'text-red-400': priceChange < 0
                    }"
                >
                    {{ displayedPrice }}
                </p>
                <span
                    class="flex items-center text-sm sm:text-base md:text-lg font-semibold"
                    :class="{
                        'text-green-400': priceChange >= 0,
                        'text-red-400': priceChange < 0
                    }"
                >
                    <svg
                        v-if="priceChange >= 0"
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
                    <svg
                        v-else
                        class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 mr-1"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M14.707 10.293a1 1 0 010 1.414L10 16.414l-4.707-4.707a1 1 0 011.414-1.414L9 13.586V4a1 1 0 112 0v9.586l2.293-2.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                    {{ priceChange }} %
                </span>
            </div>
        </div>
        <div
            class="border-t border-gray-700 mt-4 flex flex-col gap-3"
        >
            <button
                class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 sm:py-3 rounded-lg shadow-md transition duration-300 cursor-pointer"
            >
                Favorite
            </button>
            <Link
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 sm:py-3 rounded-lg shadow-md transition duration-300 cursor-pointer text-center"
                :href="route('assets.show' , { id: id })"
            >
                View Details
            </Link>
        </div>


    </div>
</template>
<script setup lang="ts">
import { computed, defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    symbol: {
        type: String,
        required: true,
    },
    image: {
        type: String,
        required: true,
    },
    price: {
        type: Number,
        required: true,
    },
    priceChange: {
        type: Number,
        required: true,
    },
    volume: {
        type: Number,
        required: true,
    }
});

const displayedPrice = computed(() => {
    return props.price.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 2,
    });
});

</script>
