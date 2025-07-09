<script setup>
</script>

<template>
  <!-- Icono giratorio -->
  <div class="flex max-w-7xl mx-auto -mb-20 px-4 mt-20">
    <div class="flex w-full items-end justify-end">
      <img src="/images/rotate.webp" class="w-20 md:w-28 lg:w-32 animate-slow-spin" />
    </div>
  </div>

  <!-- Sección principal -->
  <div class="bg-[url(/images/header.webp)] bg-[#e9e9e9] bg-no-repeat bg-center bg-opacity-100">
    <div class="max-w-7xl mx-auto flex items-center justify-center px-4 py-12 min-h-[600px] md:min-h-[700px] lg:h-[839px]">

      <!-- Grid para LG, Flex para SM/MD -->
      <div class="w-full h-full">
        <!-- Layout para pantallas grandes -->
        <div class="hidden lg:grid grid-cols-3 grid-rows-3 gap-4 h-full">
          <div></div>
          <div></div>
          <div></div>
          <div class="row-start-2"></div>
          <div class="row-start-2"></div>
          <div class="row-start-2 flex items-start justify-center pr-4">
            <h1 class="xl:text-[80px] lg:text-6xl font-bold leading-none">UPCYCLING</h1>
          </div>
          <div class="row-start-3"></div>
          <div class="row-start-3"></div>
          <div class="row-start-3 flex items-center justify-center">
            <img src="/images/bolsas.png" class="max-w-full h-auto" />
          </div>
        </div>

        <!-- Layout para móviles y tablets -->
        <div class="flex flex-col lg:hidden items-center justify-center space-y-8 text-center">
          <h1 class="text-4xl md:text-6xl font-bold leading-tight">UPCYCLING</h1>
          <img src="/images/bolsas.png" class="w-3/4 max-w-md h-auto" />
        </div>
      </div>

    </div>
  </div>
</template>

<style>
@keyframes slow-spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.animate-slow-spin {
  animation: slow-spin 3s linear infinite;
}
</style>
