<template>
    <Base>
        <button @click="test" class="bg-blue-500 text-white px-4 py-2 rounded">
            Teste
        </button>
    </Base>
</template>
<script setup lang="ts">
import { Asset } from '@/types';
import Base from '@/layout/Base.vue';
const props = defineProps<{
    asset: Asset;
}>();

const test = () => {
    console.log('test');
    console.log(props.asset);
};
</script>
