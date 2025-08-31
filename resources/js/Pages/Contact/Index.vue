<script setup>
    import Navbar from '@/Components/Navbar.vue';
    import Footer from '@/Components/Footer.vue';
    import { Head } from '@inertiajs/vue3';
    import ContactForm from '@/Components/Contact/ContactForm.vue';
    const supportedLangs = ['ca', 'en']

    // Detecta el idioma actual (si está en el primer segmento)
    const pathParts = window.location.pathname.split('/')
    const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'

    // Traducciones
    const texts = {
    es: {
        title: "Tienes ideas, sugerencias o plásticos que ya no utilizas?",
        title2: "Contáctanos!",
        title3: "Nos encanta escuchar propuestas y unir fuerzas por el cambio.",
    },
    ca: {
        title: "Tens idees, suggeriments o plàstics que ja no utilitzes?",
        title2: "Contacta’ns!",
        title3: "Ens encanta escoltar propostes i sumar forces pel canvi.",
    },
    en: {
        title: "Do you have ideas, suggestions, or plastics you no longer use?",
        title2: "Contact us!",
        title3: "We love hearing ideas and joining forces for a better world.",
    }
    }

</script>
<template>
    <Head :title="currentLang === 'ca' ? 'Contacte' : currentLang === 'en' ? 'Contact' : 'Contacto'" />
    <Navbar />

    <section 
    class="relative bg-white bg-cover bg-center min-h-[1000px] flex items-start justify-center pt-16 "
    style="background-image: url('/images/phone.webp');"
  >

    <!-- Texto -->
    <div class="relative z-10 text-center max-w-6xl px-4 sm:px-6 lg:px-8 pt-16 md:pt-24">
      <h2 class="text-lg sm:text-xl md:text-3xl text-gray-800 leading-relaxed">
        {{ texts[currentLang].title }}
      </h2>
      <h2 class="text-lg sm:text-xl md:text-3xl font-bold text-gray-800 leading-relaxed">
        {{ texts[currentLang].title2 }}
      </h2>
      <h2 class="text-lg sm:text-xl md:text-3xl text-gray-800 leading-relaxed">
        {{ texts[currentLang].title3 }}
      </h2>
      
    </div>
  </section>

    <ContactForm />

    <Footer/>
</template>