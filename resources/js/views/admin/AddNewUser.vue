<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const name = ref('');
const email = ref('');
const password = ref('');
const passwordConfirmation = ref('');
const role = ref('editor');

const handleSubmit = () => {
  if (password.value !== passwordConfirmation.value) {
    alert('Password and confirmation do not match!');
    return;
  }
  // Placeholder for actual user creation logic
  alert(`Creating user:\nName: ${name.value}\nEmail: ${email.value}\nRole: ${role.value}`);
  router.push({ name: 'AdminUserManagement' }); // Redirect back to user list
};
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">Add New User</h1>
    
    <div class="bg-slate-900 p-8 rounded-lg shadow-md max-w-2xl mx-auto">
      <form @submit.prevent="handleSubmit" class="space-y-6">
        <!-- Name -->
        <div>
          <label for="name" class="block mb-2 text-sm font-medium text-gray-300">Name</label>
          <input v-model="name" type="text" id="name" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
          <input v-model="email" type="email" id="email" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Role -->
        <div>
          <label for="role" class="block mb-2 text-sm font-medium text-gray-300">Role</label>
          <select v-model="role" id="role" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
            <option value="admin">Admin</option>
            <option value="editor">Editor</option>
          </select>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
          <input v-model="password" type="password" id="password" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-300">Confirm Password</label>
          <input v-model="passwordConfirmation" type="password" id="password_confirmation" class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required />
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
          <router-link :to="{ name: 'AdminUserManagement' }" class="px-5 py-2.5 text-sm font-medium text-gray-300 hover:text-white">Cancel</router-link>
          <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-400">Create User</button>
        </div>
      </form>
    </div>
  </div>
</template>
