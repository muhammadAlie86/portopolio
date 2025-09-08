<script setup>
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

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
  <Bar :data="chartData" :options="chartOptions" />
</template>
