<script setup>
const articles = [
  {
    title: "Membangun UI Modern dengan Vue 3 & Tailwind",
    description: "Belajar step by step membuat UI responsif dengan Vue 3 + Tailwind CSS.",
    url: "https://medium.com/@username/vue-tailwind-guide",
  },
  {
    title: "Best Practices dalam Frontend Development",
    description: "Tips menulis kode frontend yang scalable dan mudah di-maintain.",
    url: "https://dev.to/username/frontend-best-practices",
  },
  {
    title: "Belajar Integrasi API dengan Axios di Vue",
    description: "Tutorial dasar integrasi API REST menggunakan Axios di Vue.js.",
    url: "https://blog.example.com/vue-axios-tutorial",
  },
];
</script>

<template>
  <section class="bg-slate-800 py-12">
    <div class="container mx-auto px-6">
      <!-- Title -->
      <div class="text-center mb-10">
        <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest">
          Articles
        </h2>
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </div>

      <!-- Articles List -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="(article, index) in articles"
          :key="index"
          class="bg-slate-700 p-6 rounded-lg shadow-lg hover:scale-105 transition"
        >
          <h3 class="text-white text-xl font-semibold mb-2">
            {{ article.title }}
          </h3>
          <p class="text-gray-400 text-sm mb-4">
            {{ article.description }}
          </p>
          <a
            :href="article.url"
            target="_blank"
            rel="noopener noreferrer"
            class="text-yellow-400 font-medium hover:underline"
          >
            Baca Selengkapnya →
          </a>
        </div>
      </div>
    </div>
  </section>
</template>
