<template>
    <Transition name="slide-fade-top-right">
    <div
        v-if="isVisible"
        class="fixed top-4 right-4 z-50 rounded-md shadow-lg w-96"
        :class="notificationClasses"
    >
        <div class="p-4">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <template v-if="type === 'success'">
                        <svg class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </template>
                    <template v-else-if="type === 'error'">
                        <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m2-2l-2-2m4 4v-8m-4 4h8" />
                        </svg>
                    </template>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="text-sm font-medium" :class="textColorClasses">
                        {{ message }}
                    </p>
                </div>
                <div class="ml-2 flex-shrink-0">
                    <button type="button" class="inline-flex rounded-md p-2 focus:outline-none focus:ring-2" :class="closeButtonClasses" @click="close">
                        <span class="sr-only">Close</span>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </Transition>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';

const props = defineProps({
    type: {
        type: String,
        required: true,
        validator: (value) => ['success', 'error'].includes(value),
    },
    message: {
        type: String,
        required: true,
    },
    duration: {
        type: Number,
        default: 3000,
    },
});

const isVisible = ref(false);
let timeoutId = null;

const notificationClasses = computed(() => ({
    'bg-green-100': props.type === 'success',
    'bg-red-100': props.type === 'error',
    'border-green-200': props.type === 'success',
    'border-red-200': props.type === 'error',
    'border': true,
}));

const textColorClasses = computed(() => ({
    'text-green-700': props.type === 'success',
    'text-red-700': props.type === 'error',
}));

const closeButtonClasses = computed(() => ({
    'bg-green-50': props.type === 'success',
    'text-green-500': props.type === 'success',
    'hover:bg-green-100': props.type === 'success',
    'focus:ring-green-500': props.type === 'success',

    'bg-red-50': props.type === 'error',
    'text-red-500': props.type === 'error',
    'hover:bg-red-100': props.type === 'error',
    'focus:ring-red-500': props.type === 'error',
}));

const emit = defineEmits(['close']);

onMounted(() => {
    showNotification();
});

watch(isVisible, (newValue) => {
    if (newValue && props.duration > 0) {
        clearTimeout(timeoutId);
            timeoutId = setTimeout(() => {
            isVisible.value = false;
            emit('close');
        }, props.duration);
    }
});

function showNotification() {
    isVisible.value = true;
}

function close() {
    isVisible.value = false;
    emit('close');
    clearTimeout(timeoutId);
}
</script>

<style scoped>
.slide-fade-top-right-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-top-right-leave-active {
    transition: all 0.2s cubic-bezier(1, 0.5, 0.8, 1) 0.1s;
}

.slide-fade-top-right-enter-from {
    opacity: 0;
    transform: translateX(20px) translateY(-20px);
}

.slide-fade-top-right-leave-to {
    opacity: 0;
    transform: translateX(20px) translateY(-20px);
}
</style>
