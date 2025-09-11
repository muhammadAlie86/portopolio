<script setup>
// Komponen ini menerima satu prop 'show' untuk mengontrol visibilitasnya
// dan mengirimkan event 'close' saat user ingin menutup modal.
defineProps({
  show: {
    type: Boolean,
    required: true,
  },
});

const emit = defineEmits(['close']);

const closeModal = () => {
  emit('close');
};
</script>

<template>
  <!-- Root element untuk transisi -->
  <transition
    enter-active-class="transition ease-out duration-200"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-active-class="transition ease-in duration-150"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <!-- Backdrop / Overlay -->
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" @click.self="closeModal">
      <!-- Panel Modal -->
      <div class="w-full max-w-md p-6 bg-slate-800 rounded-lg shadow-xl">
        <!-- Header dengan Slot untuk Judul -->
        <div class="flex items-start justify-between pb-4 border-b border-slate-700">
          <h3 class="text-xl font-semibold text-white">
            <slot name="title">Default Title</slot>
          </h3>
          <button @click="closeModal" class="text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
        </div>

        <!-- Body dengan Slot untuk Konten -->
        <div class="py-4 text-gray-300">
          <slot name="body">Default body content.</slot>
        </div>

        <!-- Footer dengan Slot untuk Tombol Aksi -->
        <div class="flex justify-end pt-4 border-t border-slate-700">
          <slot name="footer">
            <button @click="closeModal" class="px-4 py-2 text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
              Close
            </button>
          </slot>
        </div>
      </div>
    </div>
  </transition>
</template>
