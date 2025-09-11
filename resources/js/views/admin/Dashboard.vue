<script setup>
import AdminSideBar from '../../components/layout/AdminSideBar.vue';
</script>

<template>
  <div class="flex">
    <AdminSideBar />
    <div class="flex-grow p-8">
      <h1 class="text-3xl font-bold text-white mb-6">Dashboard</h1>
      
      <!-- Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-slate-900 p-6 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold text-gray-400">Total Visits</h2>
          <p class="text-3xl font-bold text-white mt-2">1,234</p>
        </div>
        <div class="bg-slate-900 p-6 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold text-gray-400">Total Articles</h2>
          <p class="text-3xl font-bold text-white mt-2">27</p>
        </div>
        <div class="bg-slate-900 p-6 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold text-gray-400">Total Projects</h2>
          <p class="text-3xl font-bold text-white mt-2">12</p>
        </div>
        <div class="bg-slate-900 p-6 rounded-lg shadow-md">
          <h2 class="text-lg font-semibold text-gray-400">Total Skills</h2>
          <p class="text-3xl font-bold text-white mt-2">15</p>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="mt-8">
        <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
          <router-link :to="{ name: 'AdminAddNewProject' }" class="bg-slate-900 p-6 rounded-lg shadow-md hover:bg-slate-700 transition flex items-center space-x-4">
            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span class="text-lg font-semibold text-white">Add New Project</span>
          </router-link>
          <router-link :to="{ name: 'AdminAddNewArticle' }" class="bg-slate-900 p-6 rounded-lg shadow-md hover:bg-slate-700 transition flex items-center space-x-4">
            <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            <span class="text-lg font-semibold text-white">Write an Article</span>
          </router-link>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="mt-8 bg-slate-900 p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-white">Recent Activity</h2>
        <p class="text-gray-400 mt-2">No recent activity to show.</p>
      </div>
    </div>
  </div>
</template>