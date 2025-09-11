<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import useProjects from '@/composables/useProjects';

const route = useRoute();
const { project, loading, error, getProject } = useProjects();

const imageUrl = ref(null);

onMounted(() => {
  const projectId = route.params.id;
  if (projectId) {
    getProject(projectId);
  }
});

watch(project, (newProject) => {
  if (newProject && newProject.image) {
    imageUrl.value = `/storage/${newProject.image}`;
  }
}, { immediate: true });

</script>

<template>
  <section class="bg-slate-800 min-h-screen py-12 text-gray-200">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
      <div v-if="loading" class="text-center text-gray-400">Loading project details...</div>
      <div v-else-if="error" class="text-center text-red-500">{{ error }}</div>
      <div v-else-if="project" class="flex flex-col gap-8 items-center">
        <!-- Gambar di atas -->
        <div class="w-full">
          <img
            :src="imageUrl"
            :alt="project.title"
            class="rounded-lg shadow-lg w-full object-cover"
          />
        </div>

        <!-- Konten di bawah -->
        <div class="w-full">
          <h1 class="text-3xl font-bold text-yellow-400 mb-4 text-center">
            {{ project.title }}
          </h1>
          <p class="text-gray-300 mb-6 leading-relaxed text-center">
            {{ project.description }}
          </p>

          <!-- Tech stack -->
          <h3 class="text-lg font-semibold text-white mb-2 text-center">Tech Stack:</h3>
          <div class="flex flex-wrap justify-center gap-2 mb-6">
            <span
              v-for="(tech, i) in project.technologies.split(',')"
              :key="i"
              class="px-3 py-1 bg-slate-600 text-gray-200 text-sm rounded"
            >
              {{ tech.trim() }}
            </span>
          </div>

          <!-- Demo link -->
          <div v-if="project.demoUrl" class="text-center">
            <a
              :href="project.demoUrl"
              target="_blank"
              class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm"
            >
              View Live Demo
            </a>
          </div>
          <div v-else class="text-center">
            <span class="text-gray-400 italic">
              🔒 Demo tidak tersedia (project internal/kantor)
            </span>
          </div>
        </div>
      </div>

      <!-- Jika project tidak ditemukan -->
      <div v-else class="text-center text-gray-400">
        <h2 class="text-2xl font-bold text-red-400 mb-4">Project Not Found</h2>
        <RouterLink
          to="/project"
          class="inline-block bg-yellow-500 text-slate-900 px-4 py-2 rounded-md hover:bg-yellow-400 text-sm"
        >
          🔙 Back to Projects
        </RouterLink>
      </div>
    </div>
  </section>
</template>
