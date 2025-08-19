<template>
  <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold text-yellow-400 mb-4">
      Price  (last 7 days)
    </h2>
    <div v-if="loading" class="text-center text-gray-400">
      Loading chart data...
    </div>
    <div v-if="error" class="text-center text-red-400">
      There was an error: {{ error }}
    </div>
    <Line v-if="!loading && !error" :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Line } from 'vue-chartjs';
import { loadAssetChartData } from '@/service';
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  PointElement,
  LineElement,
  CategoryScale,
  LinearScale,
} from 'chart.js';

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  PointElement,
  LineElement,
  CategoryScale,
  LinearScale
);

const props = defineProps({
  assetId: {
    type: String,
    required: true,
  },
});

const loading = ref(true);
const error = ref(null);
const chartData = ref({});
const chartOptions = ref({
    responsive: true,
    maintainAspectRatio: true,
    scales: {
        x: {
            grid: {
                color: 'rgba(255, 255, 255, 0.1)',
            },
            ticks: {
                color: '#b0b0b0',
                callback: function (value) {
                    return new Date(this.getLabelForValue(value)).toLocaleDateString('en-US');
                },
            },
        },
        y: {
            grid: {
                color: 'rgba(255, 255, 255, 0.1)',
            },
            ticks: {
                color: '#b0b0b0',
                callback: function (value) {
                    return '$' + value.toLocaleString('en-US');
                },
            },
        },
    },
    plugins: {
        legend: {
            labels: {
                color: '#b0b0b0',
            },
        },
        tooltip: {
            callbacks: {
                label: function (context) {
                    const label = context.dataset.label || '';
                    const value = context.parsed.y;
                    return `${label}: $${value.toLocaleString('en-US')}`;
                },
                title: function (context) {
                    const timestamp = Number(context[0].label);
                    return new Date(timestamp).toLocaleDateString('en-US');
                },
            },
        },
    },
});

const loadData = async () =>  {
    try {
        const data = await loadAssetChartData(props.assetId);

        const prices = data.prices;
        const labels = prices.map((item) => item[0]);
        const priceValues = prices.map((item) => item[1]);

        chartData.value = {
            labels: labels,
            datasets: [
                {
                    label: 'Price (USD)',
                    data: priceValues,
                    backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    borderColor: '#ffc107',
                    borderWidth: 2,
                    pointBackgroundColor: '#ffc107',
                    tension: 0.4,
                },
            ],
        };
    } catch (err) {
        console.error('Error loading chart data', err);
        error.value = err.message;
    } finally {
        loading.value = false;
    }
}

onMounted(async () => {
    await loadData();
});
</script>
