<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import { defineProps } from 'vue'
import HeaderSection from '@/Components/Nosotros/HeaderSection.vue';
import FiresSection from '@/Components/Nosotros/FiresSection.vue';
import ImpactSection from '@/Components/Nosotros/ImpactSection.vue';

const props = defineProps({
    fires: Array
});

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'

</script>

<template>
  <Navbar />
  <Head :title="currentLang === 'ca' ? 'Nosaltres' : currentLang === 'en' ? 'Us' : 'Nosotros'" />
  <HeaderSection />
  <FiresSection :fires="props.fires" />
  <ImpactSection />
  <Footer />
</template>



<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>