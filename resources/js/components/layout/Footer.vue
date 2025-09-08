<script setup>
const socials = [
  { name: "GitHub", url: "https://github.com/username", icon: "🐙" },
  { name: "LinkedIn", url: "https://linkedin.com/in/username", icon: "💼" },
  { name: "Twitter", url: "https://twitter.com/username", icon: "🐦" },
];
</script>

<template>
  <footer class="bg-slate-900 text-gray-400 py-8">
    <div class="container mx-auto px-6 text-center">
      <!-- Socials -->
      <div class="flex justify-center gap-6 mb-4">
        <a
          v-for="(social, index) in socials"
          :key="index"
          :href="social.url"
          target="_blank"
          rel="noopener noreferrer"
          class="hover:text-yellow-400 transition"
        >
          <span class="text-xl">{{ social.icon }}</span>
        </a>
      </div>

      <!-- Copyright -->
      <p>
        © 2025 <span class="text-yellow-400 font-semibold">Muhammad Alie</span>.
        All Rights Reserved.
      </p>
    </div>
  </footer>
</template>
