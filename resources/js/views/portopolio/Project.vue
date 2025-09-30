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
  <div v-scroll-animation class="container mx-auto px-4 py-16">
    <h2 class="text-center text-yellow-400 font-bold text-lg uppercase tracking-widest">
        Projects
      </h2>
      <div class="flex justify-center items-center mt-2 mb-8">
        <span class="w-10 h-0.5 bg-white"></span>
        <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
        <span class="w-10 h-0.5 bg-white"></span>
      </div>

    <!-- Tampilkan pesan loading -->
    <div v-if="loading" class="text-center text-gray-400">
      <p>Loading projects...</p>
    </div>

    <!-- Tampilkan pesan error -->
    <div v-if="error" class="p-4 text-red-400 bg-red-900 rounded-lg text-center">
      <p>{{ error }}</p>
    </div>

    <transition-group 
      v-if="projects.length" 
      tag="div" 
      name="list-item"
      class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
    >
      <!-- Modifikasi dimulai di sini -->
      <router-link 
        v-for="(project, index) in projects" 
        :key="project.id" 
        :to="{ name: 'ProjectDetail', params: { id: project.id } }"
        :style="{ transitionDelay: index * 100 + 'ms' }"
        class="relative bg-slate-800 rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 flex flex-col cursor-pointer"
      >

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
    </transition-group>

  </div>
</template>