<script setup>
import { RouterLink } from 'vue-router'

// data dummy project
const projects = [
  {
    id: 1,
    title: "Mobile Banking App",
    subtitle: "Aplikasi finansial untuk transaksi perbankan",
    preview: "https://via.placeholder.com/400x250.png?text=Banking+App",
    tech: ["Kotlin", "Jetpack Compose", "Ktor"],
  },
  {
    id: 2,
    title: "E-Commerce Website",
    subtitle: "Platform belanja online dengan sistem pembayaran QRIS",
    preview: "https://via.placeholder.com/400x250.png?text=E-Commerce",
    tech: ["Vue.js", "TailwindCSS", "Laravel"],
  },
  {
    id: 3,
    title: "Internal TMS",
    subtitle: "Sistem manajemen terminal untuk perangkat kantor",
    preview: "https://via.placeholder.com/400x250.png?text=TMS",
    tech: ["Kotlin", "Compose Multiplatform", "Koin"],
  },
]
</script>

<template>
  <section class="bg-slate-800 py-12">
    <!-- Section Title -->
    <div class="text-center mb-12">
      <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest relative inline-block">
        Projects
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </h2>
    </div>

    <!-- Projects Grid -->
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="project in projects"
          :key="project.id"
          class="bg-slate-700 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition"
        >
          <!-- Image -->
          <img
            :src="project.preview"
            alt="preview"
            class="w-full h-48 object-cover"
          />

          <!-- Content -->
          <div class="p-5">
            <h3 class="text-xl font-bold text-yellow-400 mb-2">
              {{ project.title }}
            </h3>
            <p class="text-gray-300 text-sm mb-4">
              {{ project.subtitle }}
            </p>

            <!-- Tech tags -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span
                v-for="(tech, i) in project.tech"
                :key="i"
                class="px-2 py-1 bg-slate-600 text-gray-200 text-xs rounded"
              >
                {{ tech }}
              </span>
            </div>

            <!-- Detail Link -->
            <RouterLink
              :to="{ name: 'ProjectDetail', params: { id: project.id } }"
              class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm"
            >
              View Case Study
            </RouterLink>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
