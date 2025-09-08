<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const logout = () => {
  localStorage.removeItem('authToken');
  router.push({ name: 'AdminLogin' });
};
</script>

<template>
  <aside class="w-64 flex flex-col h-screen bg-slate-900 text-gray-300 shadow-xl">
    <!-- Logo -->
    <div class="p-6 text-2xl font-bold text-white border-b border-slate-700">
      Admin Panel
    </div>

    <!-- Navigation -->
    <nav class="flex-grow p-4">
      <ul>
        <li>
          <router-link 
            to="/admin/dashboard" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition"
            active-class="bg-slate-700 text-white"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/users" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition"
            active-class="bg-slate-700 text-white"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197M15 21a6 6 0 006-6v-1a3 3 0 00-3-3H9a3 3 0 00-3 3v1a6 6 0 006 6z"></path></svg>
            <span>Users</span>
          </router-link>
        </li>
        <li>
          <router-link 
            to="/admin/reports" 
            class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition"
            active-class="bg-slate-700 text-white"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Reports</span>
          </router-link>
        </li>
      </ul>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-slate-700">
      <button 
        @click="logout"
        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-slate-700 transition"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        <span>Logout</span>
      </button>
    </div>
  </aside>
</template>