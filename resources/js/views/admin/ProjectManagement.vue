<script setup>
import { onMounted, ref } from 'vue';
import useProjects from '@/composables/useProjects';
import { useRouter } from 'vue-router';
import Modal from '@/components/common/Modal.vue';

const { projects, loading, error, getProjects, deleteProject } = useProjects();
const router = useRouter();

const showDeleteModal = ref(false);
const projectToDelete = ref(null);

const handleDelete = (project) => {
  projectToDelete.value = project;
  showDeleteModal.value = true;
};

const confirmDelete = async () => {
  if (projectToDelete.value) {
    try {
      await deleteProject(projectToDelete.value.id);
    } catch (err) {
      console.error('Error deleting project:', err);
    }
  }
  showDeleteModal.value = false;
};

const handleEdit = (id) => {
  router.push({ name: 'AdminEditProject', params: { id } });
};

const handleView = (id) => {
  router.push({ name: 'ProjectDetail', params: { id } });
};

onMounted(() => {
  getProjects();
});
</script>

<template>
  <div class="container mx-auto p-4 text-white">
    <div class="flex justify-between items-center mb-4">
      <h1 class="text-2xl font-bold text-white">Project Management</h1>
      <router-link :to="{ name: 'AdminAddNewProject' }" class="btn-primary">Add New Project</router-link>
    </div>

    <div v-if="loading" class="text-center">Loading projects...</div>
    <div v-if="error" class="p-4 text-red-400 bg-red-900 rounded-lg">{{ error }}</div>

    <div v-if="projects.length" class="bg-slate-800 rounded-lg shadow-md overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-slate-700">
          <tr>
            <th class="p-4 text-left">Image</th>
            <th class="p-4 text-left">Name</th>
            <th class="p-4 text-left">Technologies</th>
            <th class="p-4 text-left">Created By</th>
            <th class="p-4 text-left">Created At</th>
            <th class="p-4 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id" class="border-b border-slate-700">
            <td class="p-4">
              <img :src="`/storage/${project.image}`" alt="Project Image" class="w-16 h-16 object-cover rounded-md" v-if="project.image">
              <span v-else>No Image</span>
            </td>
            <td class="p-4">{{ project.name }}</td>
            <td class="p-4">{{ project.technologies }}</td>
            <td class="p-4">{{ project.creator.name }}</td>
            <td class="p-4">{{ new Date(project.created_at).toLocaleDateString() }}</td>
            <td class="p-4">
              <button @click="handleView(project.id)" class="text-green-400 hover:text-green-300 mr-2">View</button>
              <button @click="handleEdit(project.id)" class="text-blue-400 hover:text-blue-300 mr-2">Edit</button>
              <button @click="handleDelete(project)" class="text-red-400 hover:text-red-300">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <Modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #title>Delete Project</template>
      <template #body>
        <p v-if="projectToDelete">Are you sure you want to delete project {{ projectToDelete.name }}?</p>
      </template>
      <template #footer>
        <button @click="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition mr-2">Delete</button>
        <button @click="showDeleteModal = false" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Cancel</button>
      </template>
    </Modal>

  </div>
</template>

<style scoped>
.btn-primary {
  @apply px-4 py-2 text-white bg-yellow-600 hover:bg-yellow-700 rounded-lg;
}
</style>
