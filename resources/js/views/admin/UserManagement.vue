<script setup>
import { onMounted, ref } from 'vue';
import useUsers from '@/composables/useUsers';
import useAuth from '@/composables/useAuth';
import { useRouter } from 'vue-router';
import Modal from '@/components/common/Modal.vue';

const { users, loading, error, getUsers, destroyUser, toggleUserActive } = useUsers();
const { user: loggedInUser } = useAuth();
const router = useRouter();

const showDeleteModal = ref(false);
const userToDelete = ref(null);
const showToggleActiveModal = ref(false);
const userToToggle = ref(null);

const handleDelete = (user) => {
  userToDelete.value = user;
  showDeleteModal.value = true;
};

const confirmDelete = async () => {
  if (userToDelete.value) {
    try {
      await destroyUser(userToDelete.value.id);
    } catch (err) {
      console.error('Error deleting user:', err);
    }
  }
  showDeleteModal.value = false;
};

const handleEdit = (id) => {
  router.push({ name: 'AdminEditUser', params: { id } });
};

const handleToggleActive = (user) => {
  userToToggle.value = user;
  showToggleActiveModal.value = true;
};

const confirmToggleActive = async () => {
  if (userToToggle.value) {
    try {
      await toggleUserActive(userToToggle.value.id);
    } catch (err) {
      console.error('Error toggling user status:', err);
    }
  }
  showToggleActiveModal.value = false;
};

onMounted(() => {
  getUsers();
});
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">User Management</h1>
    
    <div class="bg-slate-900 p-6 rounded-lg shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">User List</h2>
        <router-link :to="{ name: 'AdminAddNewUser' }" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Add New User</router-link>
      </div>
      
      <!-- Tampilkan pesan loading -->
      <div v-if="loading" class="text-center text-gray-400 mb-4">Loading users...</div>
      
      <!-- Tampilkan pesan error -->
      <div v-if="error" class="p-4 mb-4 text-sm text-red-400 bg-red-900 rounded-lg" role="alert">
        {{ error }}
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-gray-300">
          <thead class="bg-slate-700 text-gray-100">
            <tr>
              <th class="p-4">ID</th>
              <th class="p-4">Name</th>
              <th class="p-4">Username</th>
              <th class="p-4">Email</th>
              <th class="p-4">Role</th>
              <th class="p-4">Created By</th>
              <th class="p-4">Created At</th>
              <th class="p-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!loading && users.length === 0">
              <td colspan="8" class="text-center p-4 text-gray-500">No users found.</td>
            </tr>
            <tr v-for="user in users" :key="user.id" class="border-b border-slate-700">
              <td class="p-4">{{ user.id }}</td>
              <td class="p-4">{{ user.name }}</td>
              <td class="p-4">{{ user.username }}</td>
              <td class="p-4">{{ user.email }}</td>
              <td class="p-4">{{ user.role }}</td>
              <td class="p-4">{{ user.creator ? user.creator.name : 'N/A' }}</td>
              <td class="p-4">{{ new Date(user.created_at).toLocaleDateString() }}</td>
              <td class="p-4">
                <button @click="handleEdit(user.id)" class="text-blue-400 hover:text-blue-300 mr-2">Edit</button>
                <button @click="handleDelete(user)" class="text-red-400 hover:text-red-300 mr-2" :disabled="loggedInUser && loggedInUser.id === user.id">Delete</button>
                <button @click="handleToggleActive(user)" class="text-yellow-400 hover:text-yellow-300" :disabled="loggedInUser && loggedInUser.id === user.id">{{ user.is_active ? 'Deactivate' : 'Activate' }}</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <Modal :show="showDeleteModal" @close="showDeleteModal = false">
      <template #title>Delete User</template>
      <template #body>
        <p v-if="userToDelete">Are you sure you want to delete user {{ userToDelete.name }}?</p>
      </template>
      <template #footer>
        <button @click="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition mr-2">Delete</button>
        <button @click="showDeleteModal = false" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Cancel</button>
      </template>
    </Modal>

    <Modal :show="showToggleActiveModal" @close="showToggleActiveModal = false">
      <template #title>{{ userToToggle && userToToggle.is_active ? 'Deactivate' : 'Activate' }} User</template>
      <template #body>
        <p v-if="userToToggle">Are you sure you want to {{ userToToggle.is_active ? 'deactivate' : 'activate' }} user {{ userToToggle.name }}?</p>
      </template>
      <template #footer>
        <button @click="confirmToggleActive" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition mr-2">{{ userToToggle && userToToggle.is_active ? 'Deactivate' : 'Activate' }}</button>
        <button @click="showToggleActiveModal = false" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Cancel</button>
      </template>
    </Modal>

  </div>
</template>
