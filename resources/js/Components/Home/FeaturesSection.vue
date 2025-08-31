<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import MapPin from '@/Components/Mappin.vue';
import Rotate from '@/Components/Rotate.vue';
import Hand from '@/Components/Hand.vue';


// Detectar idioma desde la URL
const pathParts = window.location.pathname.split('/');
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es';

// Textos traducidos
const featuresByLang = {
  ca: [
    {
      icon: Rotate,
      title: "Plàstics Reciclats",
      description: "Donem nova vida als plàtic. Transformem bosses, embalatges, malles de vegetals en complements únics, funcionals i artístics."
    },
    {
      icon: Hand,
      title: "Fet a mà",
      description: "Cada peça és una obra única, feta a mà amb cura i passió. Funcionalitat i bellesa van de la mà."
    },
    {
      icon: MapPin,
      title: "Producció local",
      description: "Disseny i producció 100% empordanesa. Treballem arrelats al territori, inspirats per la natura i la cultura local."
    }
  ],
  es: [
    {
      icon: Rotate,
      title: "Plásticos Reciclados",
      description: "Damos nueva vida al plástico. Transformamos bolsas, embalajes y mallas de vegetales en complementos únicos, funcionales y artísticos."
    },
    {
      icon: Hand,
      title: "Hecho a mano",
      description: "Cada pieza es una obra única, hecha a mano con cuidado y pasión. Funcionalidad y belleza van de la mano."
    },
    {
      icon: MapPin,
      title: "Producción local",
      description: "Diseño y producción 100% ampurdanesa. Trabajamos arraigados al territorio, inspirados por la naturaleza y la cultura local."
    }
  ],
  en: [
    {
      icon: Rotate,
      title: "Recycled Plastics",
      description: "We give new life to plastic. We transform bags, packaging, and vegetable nets into unique, functional, and artistic accessories."
    },
    {
      icon: Hand,
      title: "Handmade",
      description: "Each piece is a unique creation, handmade with care and passion. Functionality and beauty go hand in hand."
    },
    {
      icon: MapPin,
      title: "Local Production",
      description: "100% Empordà design and production. We work rooted in the territory, inspired by nature and local culture."
    }
  ]
};


const selectedIndex = ref(0);
const cardsPerView = ref(3);

// Acceder a las características según idioma
const features = computed(() => featuresByLang[currentLang] || featuresByLang.es);

const totalCards = features.value.length;

function updateCardsPerView() {
  cardsPerView.value = window.innerWidth < 768 ? 1 : 3;
}

function next() {
  selectedIndex.value = (selectedIndex.value + 1) % (totalCards - cardsPerView.value + 1);
}

let interval = null;

onMounted(() => {
  updateCardsPerView();
  window.addEventListener('resize', updateCardsPerView);
  interval = setInterval(next, 5000);
});

onUnmounted(() => {
  clearInterval(interval);
  window.removeEventListener('resize', updateCardsPerView);
});
</script>


<template>
  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 v-if="currentLang === 'ca'" class="text-3xl font-light mb-4">El Nostre Compromís</h2>
        <h2 v-if="currentLang === 'es'" class="text-3xl font-light mb-4">Nuestro Compromiso</h2>
        <h2 v-if="currentLang === 'en'" class="text-3xl font-light mb-4">Our Commitment</h2>
        <div class="flex justify-center items-center max-w-4xl mx-auto mb-6">
  <span v-if="currentLang === 'ca'" class="text-gray-600 text-center text-lg leading-snug">
    A 
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo_nidees.png" alt="NiDEES logo" />
    recuperem plàstics i materials per crear peces úniques,
    <br>reduint els residus i contribuint a un món més respectuós amb el planeta.
    <br>Cada producte és una acció cap a un món més sostenible.
  </span>

  <span v-else-if="currentLang === 'es'" class="text-gray-600 text-center text-lg leading-snug">
    En 
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo_nidees.png" alt="NiDEES logo" />
    recuperamos plásticos y materiales para crear piezas únicas,
    <br>reduciendo los residuos y contribuyendo a un mundo más respetuoso con el planeta.
    <br>Cada producto es una acción hacia un mundo más sostenible.
  </span>

  <span v-else class="text-gray-600 text-center text-lg leading-snug">
    At 
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo_nidees.png" alt="NiDEES logo" />
    we recover plastics and materials to create unique pieces,
    <br>reducing waste and contributing to a planet-friendly world.
    <br>Each product is a step toward a more sustainable future.
  </span>
</div>

      </div>

      <div class="relative overflow-hidden">
        <!-- Carrusel -->
        <div 
          class="flex transition-transform duration-500 ease-in-out"
          :style="{ transform: `translateX(-${selectedIndex * (100 / cardsPerView)}%)` }"
        >
          <div 
            v-for="(feature, index) in features" 
            :key="index" 
            class="flex-shrink-0 px-4"
            :style="{ width: `${100 / cardsPerView}%` }"
          >
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 h-full flex flex-col items-center text-center">
              <component :is="feature.icon" class="h-8 w-8 text-emerald-600 mb-4" />
              <h3 class="text-xl font-semibold mb-3">{{ feature.title }}</h3>
              <p class="text-gray-600">{{ feature.description }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Punts de navegació -->
      <div class="flex justify-center gap-2 mt-8">
        <button
          v-for="i in (totalCards - cardsPerView + 1)"
          :key="i"
          :class="{
            'w-2 h-2 rounded-full transition-colors duration-200': true,
            'bg-emerald-600': selectedIndex === i - 1,
            'bg-gray-300 hover:bg-emerald-400': selectedIndex !== i - 1,
          }"
          @click="selectedIndex = i - 1"
          :aria-label="`Go to slide ${i}`"
        />
      </div>
    </div>
  </section>
</template>


