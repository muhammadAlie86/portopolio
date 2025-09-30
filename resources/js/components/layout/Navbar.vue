<template>
  <header class="bg-[#1b1e34] w-full sticky top-0 z-50" >
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
      <!-- Logo -->
      <a @click.prevent="scrollToSection('#home')" href="#home" class="flex items-center cursor-pointer">
        <span class="text-2xl font-extrabold text-white tracking-wide">
          My <span class="text-yellow-400">Fortopolio</span>
        </span>
      </a>

      <!-- Navigation -->
      <nav class="flex space-x-8">
        <a @click.prevent="scrollToSection('#home')" href="#home" class="text-white hover:text-yellow-400 transition cursor-pointer">Home</a>
        <a @click.prevent="scrollToSection('#about')" href="#about" class="text-white hover:text-yellow-400 transition cursor-pointer">About Me</a>
        <a @click.prevent="scrollToSection('#skills')" href="#skills" class="text-white hover:text-yellow-400 transition cursor-pointer">Skills</a>
        <a @click.prevent="scrollToSection('#experience')" href="#experience" class="text-white hover:text-yellow-400 transition cursor-pointer">Experience</a>
        <a @click.prevent="scrollToSection('#projects')" href="#projects" class="text-white hover:text-yellow-400 transition cursor-pointer">Project</a>
        <a @click.prevent="scrollToSection('#articles')" href="#articles" class="text-white hover:text-yellow-400 transition cursor-pointer">Article</a>
        <a @click.prevent="scrollToSection('#contact')" href="#contact" class="text-white hover:text-yellow-400 transition cursor-pointer">Contact Me</a>
      </nav>
    </div>
  </header>
</template>

<script setup>
const scrollToSection = (hash) => {
  const element = document.querySelector(hash);
  if (element) {
    window.scrollTo({
      top: element.offsetTop,
      behavior: 'smooth',
    });
  }
};
</script>