<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import useArticles from '@/composables/useArticles';
import Modal from '@/components/common/Modal.vue';

const router = useRouter();
const { error, loading, createArticle } = useArticles();

const form = ref({
  title: '',
  content: '',
  image: null,
});

const imageUrl = ref(null);

const handleFileChange = (e) => {
  const file = e.target.files[0];
  form.value.image = file;
  if (file) {
    imageUrl.value = URL.createObjectURL(file);
  }
};

const isModalVisible = ref(false);
const modalContent = ref({
  title: '',
  body: '',
  isError: false,
});

const handleCreateArticle = async () => {
  const formData = new FormData();
  formData.append('title', form.value.title);
  formData.append('content', form.value.content);
  if (form.value.image) {
    formData.append('image', form.value.image);
  }

  try {
    await createArticle(formData);
    modalContent.value = {
      title: 'Success',
      body: 'Article has been successfully added.',
      isError: false,
    };
    isModalVisible.value = true;
  } catch (err) {
    modalContent.value = {
      title: 'Error',
      body: error.value, // Ambil pesan error dari composable
      isError: true,
    };
    isModalVisible.value = true;
    console.error('Failed to create article:', err);
  }
};

const closeModalAndRedirect = () => {
  isModalVisible.value = false;
  if (!modalContent.value.isError) {
    router.push({ name: 'AdminArticleManagement' });
  }
};
</script>

<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Add New Article</h1>
    <form @submit.prevent="handleCreateArticle" class="bg-slate-800 p-6 rounded-lg shadow-md">
      <div class="space-y-4">
        <div>
          <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Article Title</label>
          <input v-model="form.title" type="text" id="title" class="input-field" required />
        </div>
        <div>
          <label for="content" class="block mb-2 text-sm font-medium text-gray-300">Content</label>
          <textarea v-model="form.content" id="content" rows="10" class="input-field"></textarea>
        </div>
        <div>
          <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Article Image</label>
          <input @change="handleFileChange" type="file" id="image" class="input-field" />
        </div>
        <div v-if="imageUrl">
          <img :src="imageUrl" class="mt-4 w-full max-w-xs" />
        </div>
      </div>
      <div class="mt-6">
        <button type="submit" :disabled="loading" class="btn-primary">
          <span v-if="loading">Creating...</span>
          <span v-else>Create Article</span>
        </button>
      </div>
    </form>

    <Modal :show="isModalVisible" @close="closeModalAndRedirect">
      <template #title>
        <span :class="modalContent.isError ? 'text-red-400' : 'text-green-400'">
          {{ modalContent.title }}
        </span>
      </template>
      <template #body>
        <p>{{ modalContent.body }}</p>
      </template>
    </Modal>
  </div>
</template>

<style scoped>
.input-field {
  @apply bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5;
}
.btn-primary {
  @apply w-full text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50;
}
</style>