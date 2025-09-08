<script setup>
</script>
<template>
  <section class="bg-slate-800 py-10">
    <!-- Judul -->
    <div class="text-center mb-12">
      <h2
        class="text-yellow-400 font-bold text-lg uppercase tracking-widest relative inline-block"
      >
        About Me
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </h2>
    </div>

    <!-- Isi -->
    <div class="container mx-auto px-6 md:px-12 lg:px-20">
      <div class="flex flex-col md:flex-row items-center md:items-start gap-12">
        <!-- Foto kiri -->
        <div class="w-full md:w-1/3 flex justify-center">
          <img
            src="https://via.placeholder.com/300"
            alt="Profile"
            class="rounded-full shadow-lg border-4 border-yellow-400 w-64 h-64 object-cover"
          />
        </div>

        <!-- Konten kanan -->
        <div class="w-full md:w-2/3">
          <h3 class="text-2xl text-white font-semibold mb-4">I'm Muhammad Alie</h3>
          <p class="text-gray-300 leading-relaxed mb-4">
            I am a
            <span class="text-yellow-400 font-semibold">Software Engineer</span>
            who loves building modern web applications and crafting clean user
            interfaces. With experience in frontend technologies like Vue.js,
            React, and Tailwind CSS, I bring ideas to life with pixel-perfect
            code.
          </p>
          <p class="text-gray-400 leading-relaxed">
            Outside of coding, I enjoy learning new tech stacks, sharing
            knowledge, and exploring creative solutions for real-world problems.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>
