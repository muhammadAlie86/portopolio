<script setup>
const contacts = [
  { name: "Email", url: "mailto:youremail@gmail.com", icon: "✉️" },
  { name: "LinkedIn", url: "https://linkedin.com/in/username", icon: "💼" },
  { name: "GitHub", url: "https://github.com/username", icon: "🐙" },
  { name: "Twitter", url: "https://twitter.com/username", icon: "🐦" },
];
</script>

<template>
  <section class="bg-slate-900 py-16">
    <div class="container mx-auto px-6 text-center">
      <!-- Title -->
      <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest">
        Contact Me
      </h2>
      <div class="flex justify-center items-center mt-2 mb-8">
        <span class="w-10 h-0.5 bg-white"></span>
        <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
        <span class="w-10 h-0.5 bg-white"></span>
      </div>

      <!-- Description -->
      <p class="text-gray-300 mb-6">
        Feel free to reach out for collaborations, questions, or just to say hi!
      </p>

      <!-- Contact Links -->
      <div class="flex justify-center gap-6 flex-wrap">
        <a
          v-for="(contact, index) in contacts"
          :key="index"
          :href="contact.url"
          target="_blank"
          rel="noopener noreferrer"
          class="bg-slate-700 text-white px-6 py-3 rounded-lg shadow-md hover:bg-yellow-400 hover:text-black transition flex items-center gap-2"
        >
          <span>{{ contact.icon }}</span> {{ contact.name }}
        </a>
      </div>
    </div>
  </section>
</template>
