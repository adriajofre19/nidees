<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';
import { Recycle, Hammer, MapPin, Leaf, Heart, ShieldCheck } from 'lucide-vue-next';

const features = [
  {
    icon: Recycle,
    title: "Producte Reciclat",
    description: "Transformem bosses de plàstic en peces úniques, donant una segona vida als residus i reduint l'impacte ambiental."
  },
  {
    icon: Hammer,
    title: "Artesania Local",
    description: "Cada peça és elaborada a mà amb cura i dedicació, assegurant la màxima qualitat i atenció als detalls."
  },
  {
    icon: MapPin,
    title: "Fet a Girona",
    description: "Som una empresa local compromesa amb el desenvolupament sostenible de la nostra comunitat."
  },
  {
    icon: Leaf,
    title: "Moda Sostenible",
    description: "Creem moda ètica i sostenible que respecta el medi ambient sense renunciar a l'estil i la funcionalitat."
  },
  {
    icon: Heart,
    title: "Disseny Únic",
    description: "Cada producte és únic i irrepetible, amb dissenys exclusius que reflecteixen la nostra passió per l'artesania."
  },
  {
    icon: ShieldCheck,
    title: "Qualitat Garantida",
    description: "Assegurem la màxima qualitat en tots els nostres productes, amb materials duradors i acabats impecables."
  }
];

const selectedIndex = ref(0);
const cardsPerView = 3;
const totalCards = features.length;

// Funció per avançar targeta (loop infinit)
function next() {
  selectedIndex.value = (selectedIndex.value + 1) % (totalCards - cardsPerView + 1);
}



// Auto-scroll cada 5s
let interval = null;
onMounted(() => {
  interval = setInterval(next, 5000);
});

onUnmounted(() => {
  clearInterval(interval);
});
</script>

<template>
  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-light mb-4">El Nostre Compromís</h2>
          <div class="flex justify-center items-center max-w-4xl mx-auto mb-6">
            <span class="text-gray-600 text-center text-lg leading-snug">
              A 
              <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo2.png" alt="NiDEES logo" />
              recuperem plàstics i materials per crear peces úniques, 
              <br>reduint els residus i contribuint a un món més respectuós amb el planeta.
              <br>Cada producte és una acció cap a un més sostenible.
            </span>
          </div>
      </div>

      <div class="relative overflow-hidden">
        

        <!-- Carousel -->
        <div 
          class="flex transition-transform duration-500 ease-in-out"
          :style="{ transform: `translateX(-${selectedIndex * (100 / cardsPerView)}%)` }"
        >
          <div 
            v-for="(feature, index) in features" 
            :key="index" 
            class="flex-shrink-0 w-1/3 px-4"
          >
            <div class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 h-full flex flex-col items-center text-center">
              <component :is="feature.icon" class="h-8 w-8 text-emerald-600 mb-4" />
              <h3 class="text-xl font-semibold mb-3">{{
                feature.title
              }}</h3>
              <p class="text-gray-600">{{ feature.description }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Dots navegació -->
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

<style scoped>
/* Ajusta la mida de la fletxa per dispositius mòbils */
button[aria-label="Anterior"], button[aria-label="Següent"] {
  font-size: 1.5rem;
  line-height: 1;
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
}
</style>
