<script setup>
import { defineProps } from 'vue'

// Props dari route (karena router kita pakai `props: true`)
const props = defineProps({
  id: String
})

// Dummy data project (harus sama dengan list di Project.vue)
const projects = [
  {
    id: "1",
    title: "Mobile Banking App",
    description:
      "Aplikasi perbankan digital dengan fitur transaksi realtime, top-up, dan pembayaran QRIS. Fokus pada keamanan transaksi dan performa tinggi.",
    tech: ["Kotlin", "Jetpack Compose", "Ktor", "Hilt"],
    image: "https://via.placeholder.com/600x350.png?text=Banking+App",
    demoUrl: null, // project kantor → tidak ada demo
  },
  {
    id: "2",
    title: "E-Commerce Website",
    description:
      "Platform belanja online dengan integrasi QRIS, keranjang belanja, serta fitur admin dashboard untuk manajemen produk.",
    tech: ["Vue.js", "TailwindCSS", "Laravel"],
    image: "https://via.placeholder.com/600x350.png?text=E-Commerce",
    demoUrl: "https://example.com",
  },
  {
    id: "3",
    title: "Internal TMS",
    description:
      "Sistem manajemen terminal untuk perangkat kantor, mendukung konfigurasi, monitoring, dan update firmware secara terpusat.",
    tech: ["Kotlin", "Compose Multiplatform", "Koin"],
    image: "https://via.placeholder.com/600x350.png?text=TMS",
    demoUrl: null,
  },
]

// Cari project berdasarkan id
const project = projects.find((p) => p.id === props.id)
</script>

<template>
  <section class="bg-slate-800 min-h-screen py-12 text-gray-200">
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
      <div v-if="project" class="flex flex-col md:flex-row gap-12 items-start">
        <!-- Gambar kiri -->
        <div class="md:w-1/2">
          <img
            :src="project.image"
            :alt="project.title"
            class="rounded-lg shadow-lg w-full object-cover"
          />
        </div>

        <!-- Konten kanan -->
        <div class="md:w-1/2">
          <h1 class="text-3xl font-bold text-yellow-400 mb-4">
            {{ project.title }}
          </h1>
          <p class="text-gray-300 mb-6 leading-relaxed">
            {{ project.description }}
          </p>

          <!-- Tech stack -->
          <h3 class="text-lg font-semibold text-white mb-2">Tech Stack:</h3>
          <div class="flex flex-wrap gap-2 mb-6">
            <span
              v-for="(tech, i) in project.tech"
              :key="i"
              class="px-3 py-1 bg-slate-600 text-gray-200 text-sm rounded"
            >
              {{ tech }}
            </span>
          </div>

          <!-- Demo link -->
          <div v-if="project.demoUrl">
            <a
              :href="project.demoUrl"
              target="_blank"
              class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm"
            >
              View Live Demo
            </a>
          </div>
          <div v-else>
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
