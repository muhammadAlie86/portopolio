<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import useUsers from '@/composables/useUsers';
import Modal from '@/components/common/Modal.vue';

const { users, loading, error, updateUser, getUsers } = useUsers();
const route = useRoute();
const router = useRouter();

const user = ref(null);
const showUpdateModal = ref(false);

const fetchUser = async () => {
  await getUsers();
  user.value = users.value.find(u => u.id === parseInt(route.params.id));
};

const submitForm = async () => {
  try {
    await updateUser(user.value);
    showUpdateModal.value = true;
  } catch (err) {
    console.error('Error updating user:', err);
  }
};

const closeModal = () => {
  showUpdateModal.value = false;
  router.push({ name: 'AdminUserManagement' });
};

onMounted(fetchUser);
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Edit User</h1>

    <div v-if="loading" class="text-center text-gray-400 mb-4">Loading user...</div>
    <div v-if="error" class="p-4 mb-4 text-sm text-red-400 bg-red-900 rounded-lg" role="alert">
      {{ error }}
    </div>

    <form v-if="user" @submit.prevent="submitForm" class="bg-slate-900 p-6 rounded-lg shadow-md">
      <div class="mb-4">
        <label for="name" class="block text-white mb-2">Name</label>
        <input type="text" id="name" v-model="user.name" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="username" class="block text-white mb-2">Username</label>
        <input type="text" id="username" v-model="user.username" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="email" class="block text-white mb-2">Email</label>
        <input type="email" id="email" v-model="user.email" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="password" class="block text-white mb-2">Password (leave blank to keep current password)</label>
        <input type="password" id="password" v-model="user.password" class="w-full p-2 bg-slate-800 text-white rounded">
      </div>
      <div class="mb-4">
        <label for="role" class="block text-white mb-2">Role</label>
        <select id="role" v-model="user.role" class="w-full p-2 bg-slate-800 text-white rounded">
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
      </div>
      <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Update User</button>
    </form>

    <Modal :show="showUpdateModal" @close="closeModal">
      <template #title>User Updated</template>
      <template #body>
        <p>User has been updated successfully.</p>
      </template>
      <template #footer>
        <button @click="closeModal" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">OK</button>
      </template>
    </Modal>

  </div>
</template>