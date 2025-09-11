<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute } from 'vue-router';
import useArticles from '@/composables/useArticles';

const route = useRoute();
const { article, loading, error, getArticle } = useArticles();

const imageUrl = ref(null);

onMounted(() => {
  const articleSlug = route.params.slug;
  if (articleSlug) {
    getArticle(articleSlug);
  }
});

watch(article, (newArticle) => {
  if (newArticle && newArticle.image) {
    imageUrl.value = `/storage/${newArticle.image}`;
  }
}, { immediate: true });

</script>

<template>
  <div class="container mx-auto p-4 text-white">
    <div v-if="loading" class="text-center text-gray-400">Loading article...</div>
    <div v-else-if="error" class="text-center text-red-500">{{ error }}</div>
    <div v-else-if="article">
      <h1 class="text-3xl font-bold mb-4 text-yellow-400">{{ article.title }}</h1>
      <p class="text-gray-400 text-sm mb-4">By {{ article.user ? article.user.name : 'Unknown' }} on {{ new Date(article.created_at).toLocaleDateString() }}</p>
      
      <div v-if="imageUrl" class="mb-6">
        <img :src="imageUrl" :alt="article.title" class="w-full h-64 object-cover rounded-lg shadow-md" />
      </div>

      <div class="prose prose-invert max-w-none">
        <p>{{ article.content }}</p>
      </div>
    </div>
    <div v-else class="text-center text-gray-400">Article not found.</div>
  </div>
</template>

<style scoped>
/* Add any specific styles for article detail page here */
</style>