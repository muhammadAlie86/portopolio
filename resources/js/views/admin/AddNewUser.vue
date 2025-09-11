<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import useUsers from '@/composables/useUsers';
import Modal from '@/components/common/Modal.vue'; // <-- 1. Impor komponen Modal

const router = useRouter();
const { error, loading, storeUser } = useUsers();

// State untuk form
const form = ref({
  name: '',
  username: '',
  email: '',
  password: '',
  role: 'user',
});

// State untuk mengontrol modal
const isModalVisible = ref(false);
const modalContent = ref({
  title: '',
  body: '',
  isError: false,
});

const handleCreateUser = async () => {
  try {
    await storeUser({ ...form.value });
    // Jika sukses, siapkan konten modal sukses
    modalContent.value = {
      title: 'Success',
      body: 'User created successfully!',
      isError: false,
    };
    isModalVisible.value = true; // Tampilkan modal
  } catch (err) {
    // Jika gagal, siapkan konten modal error
    modalContent.value = {
      title: 'Error',
      body: error.value, // Ambil pesan error dari composable
      isError: true,
    };
    isModalVisible.value = true; // Tampilkan modal
    console.error('Failed to create user:', err);
  }
};

const closeModalAndRedirect = () => {
  isModalVisible.value = false;
  // Jika notifikasi sebelumnya bukan error, redirect ke halaman user management
  if (!modalContent.value.isError) {
    router.push({ name: 'AdminUserManagement' });
  }
};
</script>

<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Add New User</h1>

    <form @submit.prevent="handleCreateUser" class="bg-slate-800 p-6 rounded-lg shadow-md">
      <!-- ... (semua input form tetap sama) ... -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Name -->
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
          <input v-model="form.name" type="text" id="name" class="input-field" required />
        </div>

        <!-- Username -->
        <div>
          <label for="username" class="block mb-2 text-sm font-medium text-gray-300">Username</label>
          <input v-model="form.username" type="text" id="username" class="input-field" required />
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
          <input v-model="form.email" type="email" id="email" class="input-field" required />
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
          <input v-model="form.password" type="password" id="password" class="input-field" required />
        </div>

        <!-- Role -->
        <div>
          <label for="role" class="block mb-2 text-sm font-medium text-gray-300">Role</label>
          <select v-model="form.role" id="role" class="input-field">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
      </div>

      <div class="mt-6">
        <button type="submit" :disabled="loading" class="btn-primary">
          <span v-if="loading">Creating...</span>
          <span v-else>Create User</span>
        </button>
      </div>
    </form>

    <!-- 2. Panggil komponen Modal di sini -->
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
