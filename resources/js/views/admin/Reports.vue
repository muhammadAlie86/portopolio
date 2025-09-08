<script setup>
import { ref, watch, onMounted } from 'vue';
import LineChart from '../../components/admin/charts/LineChart.vue';
import Datepicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import 'vue-datepicker-next/locale/en.es'; // Anda bisa ganti locale jika perlu

// --- State untuk Datepicker ---
const today = new Date();
const sevenDaysAgo = new Date(today);
sevenDaysAgo.setDate(today.getDate() - 7);
const dateRange = ref([sevenDaysAgo, today]);

// --- State untuk Chart ---
const chartData = ref({
  labels: [],
  datasets: [
    {
      label: 'Site Visits',
      backgroundColor: '#facc15', // yellow-400
      borderColor: '#facc15',
      data: [],
      tension: 0.2
    },
  ],
});

// --- Logika untuk memperbarui chart berdasarkan rentang tanggal (simulasi panggilan API) ---
const generateChartData = () => {
  if (!dateRange.value || dateRange.value.length < 2) {
    return;
  }

  const [start, end] = dateRange.value;
  const labels = [];
  const data = [];
  let currentDate = new Date(start);

  while (currentDate <= end) {
    labels.push(currentDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
    // Membuat data acak untuk simulasi
    data.push(Math.floor(Math.random() * (300 - 50 + 1)) + 50);
    currentDate.setDate(currentDate.getDate() + 1);
  }

  chartData.value = {
    ...chartData.value,
    labels,
    datasets: [{ ...chartData.value.datasets[0], data }]
  };
};

// --- Mengawasi perubahan tanggal dan memperbarui chart ---
watch(dateRange, () => {
  generateChartData();
}, { deep: true });

// --- Memuat data awal saat komponen dimuat ---
onMounted(() => {
  generateChartData();
});
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Reports</h1>
    
    <div class="grid grid-cols-1 gap-6">
      <div class="bg-slate-900 p-6 rounded-lg shadow-md">
        <div class="flex flex-col md:flex-row justify-between md:items-center mb-4">
          <h2 class="text-xl font-bold text-white mb-4 md:mb-0">Site Visits</h2>
          <div class="w-full md:w-72">
            <Datepicker 
              v-model:value="dateRange" 
              range 
              placeholder="Select date range"
              :editable="false"
              :locale="'en'"
            />
          </div>
        </div>
        <div class="h-96">
          <LineChart :chartData="chartData" />
        </div>
      </div>
    </div>
  </div>
</template>

<style>
/* Style overrides untuk vue-datepicker-next agar cocok dengan tema gelap */
.mx-datepicker {
  width: 100% !important;
}
.mx-input {
  background-color: #1e293b !important; /* slate-800 */
  border-color: #475569 !important; /* slate-600 */
  color: #e2e8f0 !important; /* slate-200 */
  height: 42px !important;
}
.mx-datepicker-range {
  width: 100% !important;
}
.mx-calendar {
  background-color: #1e293b !important; /* slate-800 */
  border-color: #475569 !important;
}
.mx-calendar-header-label, .mx-calendar-header-arrow, .mx-calendar-content th {
  color: #e2e8f0 !important;
}
.mx-calendar-content td.cell:hover {
  background-color: #334155 !important; /* slate-700 */
}
.mx-calendar-content td.in-range, .mx-calendar-content td.actived {
  background-color: #ca8a04 !important; /* yellow-600 */
}
</style>