<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { Recycle, Hammer, MapPin, Leaf, Heart, ShieldCheck } from 'lucide-vue-next';

// Detectar idioma desde la URL
const pathParts = window.location.pathname.split('/');
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es';

// Textos traducidos
const featuresByLang = {
  ca: [
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
  ],
  es: [
    {
      icon: Recycle,
      title: "Producto Reciclado",
      description: "Transformamos bolsas de plástico en piezas únicas, dando una segunda vida a los residuos y reduciendo el impacto ambiental."
    },
    {
      icon: Hammer,
      title: "Artesanía Local",
      description: "Cada pieza está hecha a mano con cuidado y dedicación, asegurando la máxima calidad y atención al detalle."
    },
    {
      icon: MapPin,
      title: "Hecho en Girona",
      description: "Somos una empresa local comprometida con el desarrollo sostenible de nuestra comunidad."
    },
    {
      icon: Leaf,
      title: "Moda Sostenible",
      description: "Creamos moda ética y sostenible que respeta el medio ambiente sin renunciar al estilo y la funcionalidad."
    },
    {
      icon: Heart,
      title: "Diseño Único",
      description: "Cada producto es único e irrepetible, con diseños exclusivos que reflejan nuestra pasión por la artesanía."
    },
    {
      icon: ShieldCheck,
      title: "Calidad Garantizada",
      description: "Aseguramos la máxima calidad en todos nuestros productos, con materiales duraderos y acabados impecables."
    }
  ],
  en: [
    {
      icon: Recycle,
      title: "Recycled Product",
      description: "We transform plastic bags into unique pieces, giving waste a second life and reducing environmental impact."
    },
    {
      icon: Hammer,
      title: "Local Craftsmanship",
      description: "Each piece is handcrafted with care and dedication, ensuring top quality and attention to detail."
    },
    {
      icon: MapPin,
      title: "Made in Girona",
      description: "We are a local company committed to the sustainable development of our community."
    },
    {
      icon: Leaf,
      title: "Sustainable Fashion",
      description: "We create ethical and sustainable fashion that respects the environment without sacrificing style and functionality."
    },
    {
      icon: Heart,
      title: "Unique Design",
      description: "Each product is one of a kind, with exclusive designs that reflect our passion for craftsmanship."
    },
    {
      icon: ShieldCheck,
      title: "Guaranteed Quality",
      description: "We ensure the highest quality in all our products, with durable materials and impeccable finishes."
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
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo2.webp" alt="NiDEES logo" />
    recuperem plàstics i materials per crear peces úniques,
    <br>reduint els residus i contribuint a un món més respectuós amb el planeta.
    <br>Cada producte és una acció cap a un món més sostenible.
  </span>

  <span v-else-if="currentLang === 'es'" class="text-gray-600 text-center text-lg leading-snug">
    En 
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo2.webp" alt="NiDEES logo" />
    recuperamos plásticos y materiales para crear piezas únicas,
    <br>reduciendo los residuos y contribuyendo a un mundo más respetuoso con el planeta.
    <br>Cada producto es una acción hacia un mundo más sostenible.
  </span>

  <span v-else class="text-gray-600 text-center text-lg leading-snug">
    At 
    <img class="inline-block h-4 w-auto mb-1 align-middle" src="/images/logo2.webp" alt="NiDEES logo" />
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


