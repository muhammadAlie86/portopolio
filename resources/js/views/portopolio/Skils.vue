<script setup>
const skills = [
  {
    title: "Sketches",
    description: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, aliquam.",
    icon: "✏️", // Bisa pakai emoji / SVG / path gambar
  },
  {
    title: "UI/UX Design",
    description: "Membuat desain antarmuka yang modern, responsif, dan fokus pada user experience.",
    icon: "🎨",
  },
  {
    title: "Product Design",
    description: "Mengembangkan konsep dan desain produk dengan pendekatan kreatif.",
    icon: "📦",
  },
  {
    title: "Frontend Development",
    description: "Membangun aplikasi web modern dengan Vue, React, dan Tailwind.",
    icon: "💻",
  },
];
</script>

<template>
  <section class="bg-slate-800 py-12">
    <div class="container mx-auto px-6">
      <!-- Title -->
      <div class="text-center mb-10">
        <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest">
          Skills
        </h2>
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </div>

      <!-- Grid List -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <div
          v-for="(skill, index) in skills"
          :key="index"
          class="bg-slate-700 text-center p-6 rounded-lg shadow-lg hover:scale-105 transition"
        >
          <div class="mb-4 text-4xl">
            {{ skill.icon }}
          </div>
          <h3 class="text-white text-xl font-semibold mb-2">
            {{ skill.title }}
          </h3>
          <p class="text-gray-400 text-sm leading-relaxed">
            {{ skill.description }}
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
