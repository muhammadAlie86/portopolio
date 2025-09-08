<script setup>
const experiences = [
  {
    role: "Frontend Developer",
    company: "PT Teknologi Kreatif",
    period: "2022 - Sekarang",
    description: "Membangun aplikasi web modern menggunakan Vue.js, React, dan Tailwind CSS. Fokus pada UI/UX dan performa aplikasi.",
  },
  {
    role: "Software Engineer",
    company: "Startup Digital",
    period: "2020 - 2022",
    description: "Mengembangkan sistem internal, API integrasi, dan aplikasi mobile berbasis React Native.",
  },
  {
    role: "Intern Web Developer",
    company: "Agensi Kreatif",
    period: "2019 - 2020",
    description: "Membuat landing page, website company profile, serta membantu optimasi SEO.",
  },
];
</script>

<template>
  <section class="bg-slate-800 py-12">
    <div class="container mx-auto px-6">
      <!-- Title -->
      <div class="text-center mb-10">
        <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest">
          Experience
        </h2>
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </div>

      <!-- Timeline -->
      <div class="relative border-l border-gray-600 ml-6">
        <div
          v-for="(exp, index) in experiences"
          :key="index"
          class="mb-10 ml-6"
        >
          <!-- Bulatan -->
          <div class="absolute w-4 h-4 bg-yellow-400 rounded-full -left-2.5"></div>
          <!-- Konten -->
          <h3 class="text-white text-xl font-semibold">
            {{ exp.role }}
          </h3>
          <p class="text-yellow-400 font-medium">{{ exp.company }}</p>
          <span class="text-gray-400 text-sm">{{ exp.period }}</span>
          <p class="text-gray-300 mt-2 text-sm leading-relaxed">
            {{ exp.description }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
