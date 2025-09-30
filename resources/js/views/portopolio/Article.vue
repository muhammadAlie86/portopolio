<script setup>
import { onMounted } from 'vue';
import useArticles from '@/composables/useArticles';

const { articles, loading, error, getArticles } = useArticles();

onMounted(() => {
  getArticles();
});
</script>

<template>
  <section v-scroll-animation class="bg-slate-800 py-12">
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
      <div v-if="loading" class="text-center text-gray-400">Loading articles...</div>
      <div v-else-if="error" class="text-center text-red-500">{{ error }}</div>
      <div v-else-if="articles.length === 0" class="text-center text-gray-400">No articles found.</div>
      <transition-group 
        v-else 
        tag="div" 
        name="list-item"
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
      >
        <router-link
          v-for="(article, index) in articles"
          :key="article.id"
          :to="{ name: 'ArticleDetail', params: { slug: article.slug } }"
          :style="{ transitionDelay: index * 100 + 'ms' }"
          class="bg-slate-700 p-6 rounded-lg shadow-lg hover:scale-105 transition cursor-pointer"
        >
          <img
            v-if="article.image"
            :src="`/storage/${article.image}`"
            :alt="article.title"
            class="w-full h-48 object-cover rounded-t-lg mb-4"
          />
          <h3 class="text-white text-xl font-semibold mb-2">
            {{ article.title }}
          </h3>
          <p class="text-gray-400 text-sm mb-4">
            {{ article.content.substring(0, 150) + '...' }} <!-- Display a snippet of content -->
          </p>
          <span
            class="text-yellow-400 font-medium hover:underline"
          >
            Baca Selengkapnya →
          </span>
        </router-link>
      </transition-group>
    </div>
  </section>
</template>
