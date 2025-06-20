<script setup>
import { ref, defineProps } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import HeaderSection from '@/Components/Home/HeaderSection.vue';
import FeaturesSection from '@/Components/Home/FeaturesSection.vue';
import Gallery from '@/Components/Home/Gallery.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  categories: Array,
  products: Array,
});



</script>

<template>
  <Head title="Inicio" />
    <Navbar />
    <HeaderSection />
    <div class="flex flex-col items-center justify-center text-center p-8">
      <span class="text-2xl">Disseny sostenible amb <span class="font-bold">plàstics reciclats.</span> <br>
      Peçes úniques fetes a mà, combinant art i funcionalitat.</span>
    </div>
    <FeaturesSection/>
    <Gallery :products="props.products" />
 
    <Footer />
</template>