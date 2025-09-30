<script setup>
const contacts = [
  {
    name: "Email",
    url: "mailto:aliemuhammad847@gmail.com",
    icon: new URL("../../assets/ic_email.png", import.meta.url).href,
  },
  {
    name: "LinkedIn",
    url: "https://www.linkedin.com/in/muhammad-ali-mukti",
    icon: new URL("../../assets/ic_linkedin.png", import.meta.url).href,
  },
  {
    name: "GitHub",
    url: "https://github.com/muhammadalie86",
    icon: new URL("../../assets/ic_github.png", import.meta.url).href,
  },
  {
    name: "Instagram",
    url: "https://instagram.com/username",
    icon: new URL("../../assets/ic_instagram.png", import.meta.url).href,
  },
];
</script>

<template>
  <section v-scroll-animation class="bg-slate-900 py-16">
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
          <img :src="contact.icon" :alt="contact.name" class="w-5 h-5" />
          {{ contact.name }}
        </a>
      </div>
    </div>
  </section>
</template>
