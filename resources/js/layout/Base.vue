<template>
    <div>
        <nav class="bg-gray-800 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-white text-2xl font-bold">Crypto Dashboard</h1>
                <div>
                    <Link :href="route('assets.index')" class="text-white hover:text-gray-300">Home</Link>
                    <Link :href="route('favorites.index')" class="ml-4 text-white hover:text-gray-300">Favorites</Link>
                </div>
            </div>
        </nav>
        <div class="container mx-auto px-2 mt-4 sm:mt-9">
            <slot />
        </div>

    </div>
</template>
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

</script>
