<script setup>
</script>
<template>
  <section v-scroll-animation class="bg-slate-800 py-10">
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
      </p>
      <p class="text-gray-300 leading-relaxed mb-4">
          As a passionate Software Engineer, I've dedicated my career to building innovative and reliable technology solutions. I'm deeply committed to developing payment systems and POS solutions, driven by the belief that technology should simplify complex transactions and improve business efficiency. This philosophy serves as the foundation for every project I handle, from initial concept to final implementation.
      </p>
      <p class="text-gray-300 leading-relaxed mb-4">
          My expertise covers a broad spectrum, from software integration to hardware integration. I have extensive experience in connecting physical devices like card readers and printers into a digital ecosystem, ensuring every component works in harmony. My focus is not just on functionality, but also on stability and security—crucial elements in the ever-evolving world of digital payments.
      </p>
      <p class="text-gray-300 leading-relaxed mb-4">
          Throughout my career, I've developed a variety of applications on both Web and Android platforms. I've mastered the technologies and methodologies required to build responsive, high-performance applications for both desktop and mobile users. Every line of code I write is aimed at creating a smooth, intuitive user experience without compromising data security.
      </p>
      <p class="text-gray-300 leading-relaxed mb-4">
          My greatest commitment is to quality, which is proven by my ability to create applications that meet stringent production SLA (Service Level Agreement) standards. I don't just build products that work; I ensure they are reliable, scalable, and ready for the most demanding operational environments. In short, I am a dedicated problem-solver focused on delivering solutions that are well-tested and production-ready.
      </p>
         
        </div>
      </div>
    </div>
  </section>
</template>
