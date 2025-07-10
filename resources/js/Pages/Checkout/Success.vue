<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 px-4 py-20">
    <div class="max-w-md w-full bg-white rounded-xl shadow-md p-8 text-center">
      <svg
        class="mx-auto mb-6 w-20 h-20 text-green-500"
        fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
      </svg>
      <h1 class="text-3xl font-semibold text-gray-900 mb-2">Compra Realitzada amb Èxit!</h1>
      <p class="text-gray-600 mb-6">
        Gràcies per la teva compra. El teu pagament ha estat processat correctament.
      </p>
      <Link
        href="/"
        class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition"
      >
        Tornar a la botiga
      </Link>
    </div>
  </div>
</template>

<style scoped>
/* Opcional: si vols, pots afegir estils addicionals */
</style>
