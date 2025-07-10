<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4 py-20">
    <div class="max-w-md w-full bg-white rounded-xl shadow-md p-8 text-center">
      <svg
        class="mx-auto mb-6 w-20 h-20 text-red-500"
        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      <h1 class="text-3xl font-semibold text-gray-900 mb-2">Compra Cancel·lada</h1>
      <p class="text-gray-600 mb-6">
        La teva compra no s'ha completat. Si us plau, torna a intentar-ho.
      </p>
      <Link
        href="/"
        class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition"
      >
        Tornar a la botiga
      </Link>
    </div>
  </div>
</template>

<style scoped>
/* Estils addicionals opcional */
</style>
