<script setup>
import { onMounted, computed } from 'vue';
import useProjects from '@/composables/useProjects';

const { projects, loading, error, getProjects } = useProjects();

// Fungsi untuk mengubah string comma-separated menjadi array
const formatTechnologies = (techString) => {
  if (!techString) return [];
  return techString.split(',').map(tech => tech.trim());
};

onMounted(() => {
  getProjects();
});
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-8 text-white">My Projects</h1>

    <!-- Tampilkan pesan loading -->
    <div v-if="loading" class="text-center text-gray-400">
      <p>Loading projects...</p>
    </div>

    <!-- Tampilkan pesan error -->
    <div v-if="error" class="p-4 text-red-400 bg-red-900 rounded-lg text-center">
      <p>{{ error }}</p>
    </div>

    <div v-if="projects.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Modifikasi dimulai di sini -->
      <router-link 
        v-for="project in projects" 
        :key="project.id" 
        :to="{ name: 'ProjectDetail', params: { id: project.id } }"
        class="relative bg-slate-800 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 flex flex-col cursor-pointer"
      >
        <!-- Menambahkan ID Proyek di pojok kanan atas -->
        <span class="absolute top-2 right-3 text-sm font-mono text-slate-500">#{{ String(project.id).padStart(3, '0') }}</span>

        <div class="p-6 flex-grow">
          <h2 class="text-2xl font-bold mb-2 text-yellow-500">{{ project.name }}</h2>
          <p class="text-gray-400 mb-4 min-h-[60px]">{{ project.description }}</p>
        </div>
        
        <!-- Bagian untuk menampilkan lencana teknologi -->
        <div class="p-6 pt-0">
          <h3 class="text-sm font-semibold text-gray-300 mb-2">Technologies Used:</h3>
          <div class="flex flex-wrap gap-2">
            <span 
              v-for="tech in formatTechnologies(project.technologies)" 
              :key="tech"
              class="bg-slate-700 text-yellow-400 text-xs font-medium px-2.5 py-1 rounded-full"
            >
              {{ tech }}
            </span>
          </div>
        </div>
      </router-link>
      <!-- Akhir modifikasi -->
    </div>

  </div>
</template>