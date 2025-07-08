<script setup>
    import Navbar from '@/Components/Navbar.vue';
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
    <div class="mt-16 bg-[url(/images/phone.png)] w-full h-[640px] bg-cover bg-center relative flex items-center justify-center">
        <div class="text-center max-w-2xl px-6">
        <h2 class="text-2xl md:text-3xl font-medium text-gray-800 mb-4 leading-relaxed">
            Tens idees, suggeriments o plàstics que ja no utilitzes?
        </h2>
        <p class="text-xl md:text-2xl font-bold text-gray-900 mb-6">
            Contacta'ns!
        </p>
        <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
            Ens encanta escoltar propostes i sumar forces pel convi.
        </p>
        </div>
    </div>

    <ContactForm />


</template>