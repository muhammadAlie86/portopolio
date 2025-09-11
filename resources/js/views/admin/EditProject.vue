<script setup>
import { ref, onMounted, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import useProjects from '@/composables/useProjects';
import Modal from '@/components/common/Modal.vue';

const { projects, loading, error, updateProject, getProjects } = useProjects();
const route = useRoute();
const router = useRouter();

const project = ref({ name: '', description: '', technologies: '', image: null });
const imageUrl = ref(null);
const showUpdateModal = ref(false);

const fetchProject = async () => {
  await getProjects();
  const foundProject = projects.value.find(p => p.id === parseInt(route.params.id));
  if (foundProject) {
    project.value = { ...foundProject };
    if (project.value.image) {
      imageUrl.value = `/storage/${project.value.image}`;
    }
  }
};

const handleFileChange = (e) => {
  const file = e.target.files[0];
  project.value.image = file;
  if (file) {
    imageUrl.value = URL.createObjectURL(file);
  }
};

const submitForm = async () => {
  const formData = new FormData();
  formData.append('name', project.value.name);
  formData.append('description', project.value.description);
  formData.append('technologies', project.value.technologies);
  if (project.value.image && typeof project.value.image !== 'string') {
    formData.append('image', project.value.image);
  }
  formData.append('_method', 'PUT');

  try {
    await updateProject(formData, project.value.id);
    showUpdateModal.value = true;
  } catch (err) {
    console.error('Error updating project:', err);
  }
};

const closeModal = () => {
  showUpdateModal.value = false;
  router.push({ name: 'AdminProjectManagement' });
};

onMounted(fetchProject);

</script>

<template>
  <div class="flex-grow p-8 text-white">
    <h1 class="text-3xl font-bold mb-6 text-white">Edit Project</h1>

    <div v-if="loading" class="text-center text-gray-400 mb-4">Loading project...</div>
    <div v-if="error" class="p-4 mb-4 text-sm text-red-400 bg-red-900 rounded-lg" role="alert">
      {{ error }}
    </div>

    <form v-if="project" @submit.prevent="submitForm" class="bg-slate-900 p-6 rounded-lg shadow-md">
      <div class="mb-4">
        <label for="name" class="block text-white mb-2">Name</label>
        <input type="text" id="name" v-model="project.name" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="description" class="block text-white mb-2">Description</label>
        <textarea id="description" v-model="project.description" class="w-full p-2 bg-slate-800 text-white rounded"></textarea>
      </div>
      <div class="mb-4">
        <label for="technologies" class="block text-white mb-2">Technologies</label>
        <input type="text" id="technologies" v-model="project.technologies" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="image" class="block text-white mb-2">Project Image</label>
        <input @change="handleFileChange" type="file" id="image" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div v-if="imageUrl">
        <img :src="imageUrl" class="mt-4 w-full max-w-xs" />
      </div>
      <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Update Project</button>
    </form>

    <Modal :show="showUpdateModal" @close="closeModal">
      <template #title>Project Updated</template>
      <template #body>
        <p>Project has been updated successfully.</p>
      </template>
      <template #footer>
        <button @click="closeModal" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">OK</button>
      </template>
    </Modal>

  </div>
</template>