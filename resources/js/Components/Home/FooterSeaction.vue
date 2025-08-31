<script setup>
const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'

// Traducciones
const texts = {
  es: {
    title: "En cada compra estás contribuyendo en un mundo más sostenible.",
    subtitle: "Únete a",
    suffix: "y hagamos posible el cambio."
  },
  ca: {
    title: "En cada compra estàs contribuint en un món més sostenible.",
    subtitle: "Uneix-te a",
    suffix: "i fem possible el canvi."
  },
  en: {
    title: "With every purchase you contribute to a more sustainable world.",
    subtitle: "Join",
    suffix: "and let’s make change possible."
  }
}
</script>

<template>
  <section 
    class="relative bg-white bg-cover bg-center min-h-screen flex items-start justify-center"
    style="background-image: url('/images/bags2.webp');"
  >

    <!-- Texto -->
    <div class="relative z-10 text-center max-w-6xl px-4 sm:px-6 lg:px-8 pt-16 md:pt-24">
      <h2 class="text-lg sm:text-xl md:text-3xl font-semibold text-gray-800 leading-relaxed">
        {{ texts[currentLang].title }}
      </h2>

      <p class="mt-3 text-base sm:text-xl md:text-2xl font-medium text-gray-700 flex flex-wrap items-center justify-center gap-2">
        {{ texts[currentLang].subtitle }}
        <img 
          src="/images/logo_nidees.png" 
          alt="Logo NiDEES" 
          class="h-5 sm:h-5 md:h-5 inline-block"
        />
        {{ texts[currentLang].suffix }}
      </p>
    </div>
  </section>
</template>
