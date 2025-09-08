<template>
  <div class="min-h-screen flex flex-col bg-slate-800">
    <Navbar />
    <main class="flex-grow container mx-auto">
      <router-view />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Footer from '../components/layout/Footer.vue';
import Navbar from '../components/layout/Navbar.vue';

</script>
