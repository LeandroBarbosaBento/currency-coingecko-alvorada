<template>
    <div>
        <Head title="Crypto Dashboard" />

        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-white text-2xl font-bold">Crypto Dashboard</h1>
                <div>
                    <Link
                        v-for="item in menuItems"
                        :key="item.name"
                        :href="route(item.route)"
                        class="text-white hover:text-gray-300 ml-4 p-2"
                        :class="{
                            'border-b': route().current(item.route),
                        }"
                    >
                        {{ item.name }}
                    </Link>
                </div>
            </div>
        </nav>
        <div class="container mx-auto px-2 mt-4 sm:mt-9">
            <div
                v-if="isLoading"
                class="flex items-center justify-center z-50"
            >
                <div class="loader"></div>
            </div>
            <template v-else>
                <slot />
            </template>
        </div>

    </div>
</template>
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    isLoading: {
        type: Boolean,
        default: false
    }
});

const menuItems = [
    { name: 'Home', route: 'assets.index' },
    { name: 'Favorites', route: 'favorites.index' }
];

</script>

<style scoped>
.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
