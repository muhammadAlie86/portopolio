<script setup>
const socialLinks = [
  {
    name: "Email",
    url: "https://github.com/username",
    icon: new URL("../../assets/ic_email.png", import.meta.url).href,
  },
  {
    name: "GitHub",
    url: "https://github.com/username",
    icon: new URL("../../assets/ic_github.png", import.meta.url).href,
  },
  {
    name: "LinkedIn",
    url: "https://www.linkedin.com/in/muhammad-ali-mukti",
    icon: new URL("../../assets/ic_linkedin.png", import.meta.url).href,
  },
  {
    name: "Instagram",
    url: "https://instagram.com/username",
    icon: new URL("../../assets/ic_instagram.png", import.meta.url).href,
  },
];
</script>

<template>
  <footer class="bg-slate-900 text-gray-400 py-8">
    <div class="container mx-auto px-6 text-center">
      <!-- Socials -->
      <div class="flex justify-center gap-6 mb-4">
        <a
          v-for="social in socialLinks"
          :key="social.name"
          :href="social.url"
          target="_blank"
          rel="noopener noreferrer"
          class="hover:opacity-75 transition"
        >
          <img :src="social.icon" :alt="social.name" class="w-6 h-6" />
        </a>
      </div>

      <!-- Copyright -->
      <p>
        © {{ new Date().getFullYear() }}
        <span class="text-yellow-400 font-semibold">Muhammad Alie</span>.
        All Rights Reserved.
      </p>
    </div>
  </footer>
</template>
