<script setup>
import { ref } from 'vue';
import useAuth from '@/composables/useAuth'; // <-- 1. Impor composable kita

// State lokal untuk form input
const email = ref('');
const password = ref('');

// 2. Ambil fungsi dan state yang kita butuhkan dari useAuth
const { error, login } = useAuth();

// 3. Buat fungsi untuk menangani submit form
const performLogin = async () => {
  await login({ 
    email: email.value, 
    password: password.value 
  });
};
</script>

<template>
  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-slate-900 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold text-center text-white">Admin Login</h1>
      
      <!-- Tampilkan pesan error dari composable -->
      <div v-if="error" class="p-4 mb-4 text-sm text-red-400 bg-red-900 rounded-lg" role="alert">
        {{ error }}
      </div>

      <!-- Form sekarang memanggil performLogin -->
      <form @submit.prevent="performLogin" class="space-y-6">
        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-300">Email</label>
          <input
            v-model="email"
            type="email"
            name="email"
            id="email"
            class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
            placeholder="name@company.com"
            required
          />
        </div>
        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-300">Password</label>
          <input
            v-model="password"
            type="password"
            name="password"
            id="password"
            placeholder="••••••••"
            class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
        >
          Sign in
        </button>
      </form>
    </div>
  </div>
</template>