<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const email = ref('');
const password = ref('');
const rememberMe = ref(false);
const captcha = ref('');
const captchaInput = ref('');

const generateCaptcha = () => {
  const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  let result = '';
  for (let i = 0; i < 6; i++) {
    result += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  captcha.value = result;
};

const handleLogin = () => {
  if (captchaInput.value !== captcha.value) {
    alert('Invalid CAPTCHA');
    generateCaptcha();
    captchaInput.value = '';
    return;
  }
  
  // 1. Set a dummy auth token in localStorage to simulate login
  localStorage.setItem('authToken', 'dummy-secret-token');

  // 2. Redirect to the admin dashboard
  router.push({ name: 'AdminDashboard' });
};

onMounted(() => {
  generateCaptcha();
});
</script>

<template>
  <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-8 space-y-6 bg-slate-900 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold text-center text-white">Admin Login</h1>
      <form @submit.prevent="handleLogin" class="space-y-6">
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
        <div class="flex items-center justify-between">
          <div class="flex items-start">
            <div class="flex items-center h-5">
              <input
                v-model="rememberMe"
                id="remember"
                aria-describedby="remember"
                type="checkbox"
                class="w-4 h-4 border border-slate-600 rounded bg-slate-700 focus:ring-3 focus:ring-yellow-500"
              />
            </div>
            <div class="ml-3 text-sm">
              <label for="remember" class="text-gray-400">Remember me</label>
            </div>
          </div>
        </div>
        
        <!-- CAPTCHA -->
        <div>
          <label for="captcha" class="block mb-2 text-sm font-medium text-gray-300">CAPTCHA</label>
          <div class="flex items-center space-x-4">
            <div class="px-4 py-2 bg-slate-700 rounded-lg text-white font-mono text-2xl tracking-widest select-none">
              {{ captcha }}
            </div>
            <input
              v-model="captchaInput"
              type="text"
              name="captcha"
              id="captcha"
              placeholder="Enter CAPTCHA"
              class="bg-slate-700 border border-slate-600 text-white sm:text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5"
              required
            />
          </div>
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