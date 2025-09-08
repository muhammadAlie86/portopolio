<script setup>
// Di sini nanti akan ada logika untuk mengambil data user dari API
</script>

<template>
  <div class="flex-grow p-8">
    <h1 class="text-3xl font-bold text-white mb-6">User Management</h1>
    
    <div class="bg-slate-900 p-6 rounded-lg shadow-md">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-white">User List</h2>
        <router-link :to="{ name: 'AdminAddNewUser' }" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition">Add New User</router-link>
      </div>
      
      <!-- Placeholder for user table -->
      <div class="overflow-x-auto">
        <table class="w-full text-left text-gray-300">
          <thead class="bg-slate-700 text-gray-100">
            <tr>
              <th class="p-4">Name</th>
              <th class="p-4">Email</th>
              <th class="p-4">Role</th>
              <th class="p-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- User data will be loaded here from an API -->
            <tr>
              <td colspan="4" class="text-center p-8 text-gray-500">
                User data will be loaded here...
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>