<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const title = ref('');
const content = ref('');

const handleSubmit = () => {
  // Placeholder for actual article creation logic
  alert(`Creating article:\nTitle: ${title.value}`);
  router.push({ name: 'AdminDashboard' }); // Redirect back to dashboard
};
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Write New Article</h1>
    
    <div class="bg-slate-900 p-8 rounded-lg shadow-md max-w-4xl mx-auto">
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <!-- Title -->
        <div>
          <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Article Title</label>
          <input v-model="title" type="text" id="title" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Content/Description -->
        <div>
          <label for="content" class="block mb-2 text-sm font-medium text-gray-300">Content</label>
          <textarea v-model="content" id="content" rows="15" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" placeholder="Write your article here..." required></textarea>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
          <router-link :to="{ name: 'AdminDashboard' }" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white">Cancel</router-link>
          <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-400">Publish Article</button>
        </div>
      </form>
    </div>
  </div>
</template>
