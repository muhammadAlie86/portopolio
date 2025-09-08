<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const title = ref('');
const description = ref('');
const technologies = ref('');
const imageFile = ref(null);

const handleFileChange = (e) => {
  imageFile.value = e.target.files[0];
};

const handleSubmit = () => {
  // Placeholder for actual project creation logic
  alert(`Creating project:\nTitle: ${title.value}\nDescription: ${description.value}\nTechnologies: ${technologies.value}\nImage: ${imageFile.value ? imageFile.value.name : 'No file selected'}`);
  router.push({ name: 'AdminDashboard' }); // Redirect back to dashboard for now
};
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Add New Project</h1>
    
    <div class="bg-slate-900 p-8 rounded-lg shadow-md max-w-2xl mx-auto">
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <!-- Title -->
        <div>
          <label for="title" class="block mb-2 text-sm font-medium text-gray-300">Project Title</label>
          <input v-model="title" type="text" id="title" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Description -->
        <div>
          <label for="description" class="block mb-2 text-sm font-medium text-gray-300">Description</label>
          <textarea v-model="description" id="description" rows="4" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required></textarea>
        </div>

        <!-- Image -->
        <div>
          <label for="image" class="block mb-2 text-sm font-medium text-gray-300">Project Image</label>
          <input @change="handleFileChange" type="file" id="image" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-600 file:text-white hover:file:bg-yellow-700" accept="image/*" />
        </div>

        <!-- Technologies -->
        <div>
          <label for="technologies" class="block mb-2 text-sm font-medium text-gray-300">Technologies</label>
          <input v-model="technologies" type="text" id="technologies" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" placeholder="e.g., Vue, Tailwind, Laravel" required />
          <p class="mt-1 text-xs text-gray-500">Please enter comma-separated values.</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 pt-4">
          <router-link :to="{ name: 'AdminDashboard' }" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white">Cancel</router-link>
          <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-400">Create Project</button>
        </div>
      </form>
    </div>
  </div>
</template>
