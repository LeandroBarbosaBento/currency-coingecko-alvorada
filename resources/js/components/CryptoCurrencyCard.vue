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
                <p class="text-xl sm:text-3xl md:text-5xl font-extrabold text-white">
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
                v-if="!isLoading"
                class="w-full text-white font-bold py-2 sm:py-3 rounded-lg shadow-md transition duration-300 cursor-pointer"
                :class="{
                    'bg-red-500 hover:bg-red-600': isFavorite,
                    'bg-green-500 hover:bg-green-600': !isFavorite
                }"
                @click="onButtonClick(id)"
            >
                {{ isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}
            </button>
            <button
                v-else
                class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 sm:py-3 rounded-lg shadow-md transition duration-300 cursor-pointer"
                disabled
            >
                <span class="flex items-center justify-center">
                    <svg
                        class="animate-spin h-5 w-5 mr-3"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2.93 6.243A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3.93-1.695z"
                        ></path>
                    </svg>
                    Loading...
                </span>
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
import { computed, defineProps, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import {
    markAssetAsFavorite,
    unmarkAssetAsFavorite
} from '@/service';

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
    },
    isFavorite: {
        type: Boolean,
        default: false,
    },
});

const $emit = defineEmits([
    'marked-as-favorite',
    'remove-from-favorites',
    'error'
]);

const isLoading = ref(false);

const displayedPrice = computed(() => {
    return props.price.toLocaleString('en-US', {
        style: 'currency',
        currency: 'USD',
        maximumFractionDigits: 2,
    });
});

const onButtonClick = async (id: string) => {
    try {
        isLoading.value = true;
        if (props.isFavorite) {
            await unmarkAssetAsFavorite(id);
            $emit('remove-from-favorites', id);
        } else {
            await markAssetAsFavorite(id);
            $emit('marked-as-favorite', id);
        }
    } catch (error) {
        console.error('Error toggling favorite status:', error);
        $emit('error', 'Something went wrong while updating favorite status.');
    } finally {
        isLoading.value = false;
    }
};

</script>
