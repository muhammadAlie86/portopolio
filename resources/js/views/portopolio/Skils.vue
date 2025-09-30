<script setup>
const skills = [
  { name: 'PHP', iconClass: 'devicon-php-plain' },
  { name: 'Laravel', iconClass: 'devicon-laravel-plain' },
  { name: 'JavaScript', iconClass: 'devicon-javascript-plain' },
  { name: 'Vue.js', iconClass: 'devicon-vuejs-plain' },
  { name: 'Kotlin', iconClass: 'devicon-kotlin-plain' },
  { name: 'Kotlin Multiplatform', iconClass: 'devicon-kotlin-plain' },
  { name: 'Ktor', iconClass: 'devicon-kotlin-plain' },
  { name: 'Android', iconClass: 'devicon-android-plain' },
  { name: 'Jetpack Compose', iconClass: 'devicon-android-plain' },
  { name: 'Hilt', iconClass: null },
  { name: 'Koin', iconClass: null },
  { name: 'PostgreSQL', iconClass: 'devicon-postgresql-plain' },
  { name: 'TailwindCSS', iconClass: 'devicon-tailwindcss-plain' },
  { name: 'Git', iconClass: 'devicon-git-plain' },
];
</script>

<template>
  <section v-scroll-animation class="bg-slate-800 py-16">
    <div class="container mx-auto px-6">
      <!-- Title -->
      <div class="text-center mb-12">
        <h2 class="text-yellow-400 font-bold text-lg uppercase tracking-widest">
          Skills & Technologies
        </h2>
        <div class="flex justify-center items-center mt-2">
          <span class="w-10 h-0.5 bg-white"></span>
          <span class="w-4 h-0.5 bg-yellow-400 mx-1"></span>
          <span class="w-10 h-0.5 bg-white"></span>
        </div>
      </div>

      <!-- Grid List -->
      <div class="max-w-4xl mx-auto grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-8 text-center">
        <div
          v-for="(skill, index) in skills"
          :key="index"
          class="flex flex-col items-center justify-center p-4 bg-slate-700 rounded-lg shadow-lg transform hover:scale-110 transition-transform duration-300"
        >
          <div class="h-12 w-full flex items-center justify-center">
            <i v-if="skill.iconClass" :class="skill.iconClass" class="text-4xl sm:text-5xl text-yellow-300"></i>
            <div v-else class="flex items-center justify-center w-full h-full bg-slate-800/50 rounded-lg text-yellow-300 font-bold text-base">
              {{ skill.name }}
            </div>
          </div>
          <p class="mt-3 text-sm font-semibold text-white">{{ skill.name }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
