<script setup>
import { ref, defineProps } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import HeaderSection from '@/Components/Home/HeaderSection.vue';
import FeaturesSection from '@/Components/Home/FeaturesSection.vue';
import Gallery from '@/Components/Home/Gallery.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';
import FooterSeaction from '@/Components/Home/FooterSeaction.vue';

const props = defineProps({
  categories: Array,
  products: Array,
});

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'

</script>

<template>
  <Head :title="currentLang === 'ca' ? 'Inici' : currentLang === 'en' ? 'Home' : 'Inicio'" />
    <Navbar />
    
    <HeaderSection  />
    <!-- Español -->
    <div v-if="currentLang === 'es'" class="flex flex-col items-center justify-center text-center p-8">
      <span class="text-xl lg:text-5xl">
        Diseño sostenible con <strong>plásticos reciclados.</strong> <br>
        <span class="text-lg lg:text-4xl">
          Piezas únicas hechas a mano, combinando arte y funcionalidad.
        </span>
      </span>
    </div>

    <!-- Catalán -->
    <div v-if="currentLang === 'ca'" class="flex flex-col items-center justify-center text-center p-8">
      <span class="text-xl lg:text-5xl">
        Disseny sostenible amb <strong>plàstics reciclats.</strong> <br>
        <span class="text-lg lg:text-4xl">
          Peçes úniques fetes a mà, combinant art i funcionalitat.
        </span>
      </span>
    </div>

    <!-- Inglés -->
    <div v-if="currentLang === 'en'" class="flex flex-col items-center justify-center text-center p-8">
      <span class="text-xl lg:text-5xl">
        Sustainable design with <strong>recycled plastics.</strong> <br>
        Unique handmade pieces, combining art and functionality.
      </span>
    </div>

    <FeaturesSection/>
    <Gallery :products="props.products" :categories="props.categories" />
    <FooterSeaction />
 
    <Footer />
</template>