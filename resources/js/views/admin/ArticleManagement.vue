<script setup>
import { onMounted, ref } from 'vue';
import useArticles from '@/composables/useArticles';
import Modal from '@/components/common/Modal.vue';
import { useRouter } from 'vue-router';

const { articles, loading, error, getArticles, deleteArticle } = useArticles();
const router = useRouter();

const isModalVisible = ref(false);
const modalContent = ref({
  title: '',
  body: '',
  isError: false,
});
const articleToDelete = ref(null);

onMounted(() => {
  getArticles();
});

const confirmDelete = (article) => {
  articleToDelete.value = article;
  modalContent.value = {
    title: 'Confirm Delete',
    body: `Are you sure you want to delete the article "${article.title}"?`,
    isError: false,
  };
  isModalVisible.value = true;
};

const executeDelete = async () => {
  if (articleToDelete.value) {
    try {
      await deleteArticle(articleToDelete.value.id);
      modalContent.value = {
        title: 'Success',
        body: 'Article deleted successfully.',
        isError: false,
      };
      getArticles(); // Refresh the list
    } catch (err) {
      modalContent.value = {
        title: 'Error',
        body: error.value || 'Failed to delete article.',
        isError: true,
      };
    } finally {
      articleToDelete.value = null;
      isModalVisible.value = true;
    }
  }
};

const closeModal = () => {
  isModalVisible.value = false;
  // If it was a success modal after deletion, refresh the list
  if (modalContent.value.title === 'Success' && modalContent.value.body === 'Article deleted successfully.') {
    getArticles();
  }
};

const editArticle = (id) => {
  router.push({ name: 'AdminEditArticle', params: { id } });
};

const handleView = (slug) => {
  router.push({ name: 'ArticleDetail', params: { slug } });
};
</script>

<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Article Management</h1>
    <div class="flex justify-end mb-4">
      <router-link :to="{ name: 'AdminAddNewArticle' }" class="btn-primary">Add New Article</router-link>
    </div>

    <div v-if="loading" class="text-center text-gray-400">Loading articles...</div>
    <div v-else-if="error" class="text-center text-red-500">{{ error }}</div>
    <div v-else-if="articles.length === 0" class="text-center text-gray-400">No articles found.</div>
    <div v-else class="overflow-x-auto bg-slate-800 rounded-lg shadow-md">
      <table class="min-w-full divide-y divide-slate-700">
        <thead class="bg-slate-700">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Image</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Author</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Created At</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-700">
          <tr v-for="article in articles" :key="article.id">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
              <img :src="`/storage/${article.image}`" alt="Article Image" class="w-16 h-16 object-cover rounded-md" v-if="article.image">
              <span v-else>No Image</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">{{ article.title }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ article.user ? article.user.name : 'N/A' }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ new Date(article.created_at).toLocaleDateString() }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button @click="handleView(article.slug)" class="text-green-400 hover:text-green-500 mr-3">View</button>
              <button @click="editArticle(article.id)" class="text-yellow-400 hover:text-yellow-500 mr-3">Edit</button>
              <button @click="confirmDelete(article)" class="text-red-400 hover:text-red-500">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Modal :show="isModalVisible" @close="closeModal">
      <template #title>
        <span :class="modalContent.isError ? 'text-red-400' : 'text-green-400'">
          {{ modalContent.title }}
        </span>
      </template>
      <template #body>
        <p>{{ modalContent.body }}</p>
      </template>
      <template #footer v-if="modalContent.title === 'Confirm Delete'">
        <button @click="executeDelete" class="btn-primary mr-2">Delete</button>
        <button @click="closeModal" class="btn-secondary">Cancel</button>
      </template>
    </Modal>
  </div>
</template>

<style scoped>
.btn-primary {
  @apply px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2;
}
.btn-secondary {
  @apply px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2;
}
</style>