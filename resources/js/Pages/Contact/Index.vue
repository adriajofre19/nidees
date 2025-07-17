<script setup>
    import Navbar from '@/Components/Navbar.vue';
    import Footer from '@/Components/Footer.vue';
    import { Head } from '@inertiajs/vue3';
    import ContactForm from '@/Components/Contact/ContactForm.vue';
    const supportedLangs = ['ca', 'en']

    // Detecta el idioma actual (si está en el primer segmento)
    const pathParts = window.location.pathname.split('/')
    const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'
</script>
<template>
    <Head :title="currentLang === 'ca' ? 'Contacte' : currentLang === 'en' ? 'Contact' : 'Contacto'" />
    <Navbar />
    <div class="mt-16 bg-[url(/images/phone.webp)] w-full h-[640px] bg-cover bg-center relative flex items-center justify-center">
        <div class="text-center max-w-2xl px-6">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 mb-4 leading-relaxed">
            {{ 
                currentLang === 'ca' ? 'Tens idees, suggeriments o plàstics que ja no utilitzes?' : currentLang === 'en' ? 'Do you have ideas, suggestions, or plastics you no longer use?' : '¿Tienes ideas, sugerencias o plásticos que ya no utilizas?'
            }}
            
        </h2>
        <p class="text-xl md:text-2xl font-bold text-gray-900 mb-6">
            {{ 
                currentLang === 'ca' ? 'Tens idees, suggeriments o plàstics que ja no utilitzes?' : currentLang === 'en' ? 'Contact us!' : 'Contáctanos'
            }}
        </p>
        <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
            {{ 
                currentLang === 'ca' ? 'Ens encanta escoltar propostes i sumar forces pel convi.' 
                : currentLang === 'en' ? 'We love hearing ideas and joining forces for a better coexistence.' 
                : 'Nos encanta escuchar propuestas y unir fuerzas por la convivencia.'
            }}
        </p>
        </div>
    </div>

    <ContactForm />

    <Footer/>
</template>