<template>
  <div class="w-full aspect-[4/3] sm:aspect-[16/5] md:aspect-[3.2/1] bg-gray-100 relative overflow-hidden">
    
    <!-- Fons per mòbil -->
    <div 
      class="absolute inset-0 bg-cover bg-center bg-no-repeat block md:hidden"
      style="background-image: url('/images/bags2.png')"
    ></div>

    <!-- Fons per escriptori -->
    <div 
      class="absolute inset-0 bg-cover bg-center bg-no-repeat hidden md:block"
      style="background-image: url('/images/bags.png')"
    ></div>

    <!-- Contingut -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 py-6">
      <div class="text-center space-y-3 max-w-5xl">
        <h1 class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl xl:text-4xl font-medium leading-snug">
          En cada compra estàs contribuint en un món més sostenible.
        </h1>

        <div class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1">
          <span class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl font-medium">
            Uneix-te a
          </span>
          <img 
            src="/images/logo2.png" 
            alt="Logo" 
            class="h-5 sm:h-6 md:h-7 lg:h-5 xl:h-5 w-auto" 
          />
          <span class="text-gray-800 text-base sm:text-lg md:text-2xl lg:text-3xl font-medium">
            i fem possible el canvi.
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
