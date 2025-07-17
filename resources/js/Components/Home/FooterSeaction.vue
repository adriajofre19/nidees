<script setup>
  const pathParts = window.location.pathname.split('/')
  const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'

</script>
<template>
  <div class="w-full aspect-[4/3] sm:aspect-[16/5] md:aspect-[3.2/1] bg-gray-100 relative overflow-hidden">
    
    <!-- Fons per mòbil -->
    <div class="absolute inset-0 block md:hidden">
        <!-- Imagen de fondo -->
        <div
          class="absolute inset-0 bg-cover bg-center bg-no-repeat"
          style="background-image: url('/images/bags2.webp')"
        ></div>
        
        <!-- Capa blanca con opacidad -->
        <div class="absolute inset-0 bg-white opacity-40"></div>
      </div>

    <!-- Fons per escriptori -->
    <div class="absolute inset-0 hidden md:block">
  <!-- Imagen de fondo -->
  <div 
    class="absolute inset-0 bg-cover bg-center bg-no-repeat"
    style="background-image: url('/images/bags.webp')"
  ></div>

  <!-- Capa blanca con opacidad -->
  <div class="absolute inset-0 bg-white opacity-40"></div>
</div>

    <!-- Contingut -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 py-6">
      <div class="text-center space-y-3 max-w-6xl">
        <h1 class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl xl:text-3xl font-medium leading-snug">
          {{ currentLang === 'ca' ? 'En cada compra estàs contribuint en un món més sostenible.' : 
          currentLang === 'en' ? 'In every purchase you are contributing to a more sustainable world.' : 
          'En cada compra estas contribuyendo a un mundo más sostenible.' }}
        </h1>

        <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
          <span class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl font-medium">
            {{ currentLang === 'ca' ? 'Uneix-te a' : currentLang === 'en' ? 'Join us' : 'Unete a' }}
          </span>
          <img 
            src="/images/logo2.webp" 
            alt="Logo" 
            class="h-4 sm:h-6 md:h-7 lg:h-5 xl:h-5 w-auto" 
          />
          <span class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl font-medium">
            {{ currentLang === 'ca' ? 'i fem possible el canvi.' : currentLang === 'en' ? 'and we make possible the change.' : 'y hagamos posible el cambio.' }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
