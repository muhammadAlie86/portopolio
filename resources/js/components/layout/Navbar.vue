<template>
  <header class="bg-[#1b1e34] w-full" >
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
      <!-- Logo -->
      <router-link to="/" class="flex items-center">
        <span class="text-2xl font-extrabold text-white tracking-wide">
          My <span class="text-yellow-400">Fortopolio</span>
        </span>
      </router-link>

      <!-- Navigation -->
      <nav class="flex space-x-8">
        <router-link to="/" class="text-white hover:text-yellow-400 transition">Home</router-link>
        <router-link to="/about" class="text-white hover:text-yellow-400 transition">About Me</router-link>
        <router-link to="/project" class="text-white hover:text-yellow-400 transition">Project</router-link>
        <router-link to="/skils" class="text-white hover:text-yellow-400 transition">Skills</router-link>
        <router-link to="/experience" class="text-white hover:text-yellow-400 transition">Experience</router-link>
        <router-link to="/article" class="text-white hover:text-yellow-400 transition">Article</router-link>
        <router-link to="/contact" class="text-white hover:text-yellow-400 transition">Contact Me</router-link>
      </nav>
    </div>
  </header>
</template>

<script setup>
// navbar statis, jadi tidak perlu logic
</script>