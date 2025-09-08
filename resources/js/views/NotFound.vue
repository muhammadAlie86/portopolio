<template>
  <div class="flex items-center justify-center min-h-screen bg-slate-800 text-center px-6">
    <div>
      <h1 class="text-9xl font-bold text-yellow-400">404</h1>
      <p class="text-2xl md:text-3xl font-semibold text-white mt-4">Page Not Found</p>
      <p class="text-gray-400 mt-2">Sorry, the page you are looking for does not exist.</p>
      <div class="mt-6">
        <router-link 
          to="/" 
          class="px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition"
        >
          Go Back Home
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
// No script logic needed for this simple page
</script>
