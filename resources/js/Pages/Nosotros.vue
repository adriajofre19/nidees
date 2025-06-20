<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import { defineProps } from 'vue'
import HeaderSection from '@/Components/Nosotros/HeaderSection.vue';
import FiresSection from '@/Components/Nosotros/FiresSection.vue';

const props = defineProps({
    fires: Array
});

</script>

<template>
  <Navbar />
  <Head title="Nosaltres" />
  <HeaderSection />
  <FiresSection :fires="props.fires" />
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