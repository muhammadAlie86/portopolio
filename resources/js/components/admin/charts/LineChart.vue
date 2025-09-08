<script setup>
import { Line } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale);

const props = defineProps({
  chartData: {
    type: Object,
    required: true
  },
  chartOptions: {
    type: Object,
    default: () => ({
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          ticks: { color: '#cbd5e1' }
        },
        x: {
          ticks: { color: '#cbd5e1' }
        }
      },
      plugins: {
        legend: {
          labels: { color: '#cbd5e1' }
        }
      }
    })
  }
});
</script>

<template>
  <Line :data="chartData" :options="chartOptions" />
</template>
