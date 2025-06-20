<script setup>
import { ref, computed, onMounted } from 'vue'
import {
  Recycle,
  Hammer,
  MapPin,
  Leaf,
  Heart,
  ShieldCheck,
  ChevronLeft,
  ChevronRight
} from 'lucide-vue-next'

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
]

const currentIndex = ref(0)
const visibleCount = 3

const visibleFeatures = computed(() => {
  return features.slice(currentIndex.value, currentIndex.value + visibleCount)
})

const canGoNext = computed(() => currentIndex.value + visibleCount < features.length)
const canGoPrev = computed(() => currentIndex.value > 0)

const next = () => { if (canGoNext.value) currentIndex.value++ }
const prev = () => { if (canGoPrev.value) currentIndex.value-- }

let interval
onMounted(() => {
  interval = setInterval(() => {
    if (canGoNext.value) next()
    else currentIndex.value = 0
  }, 5000)
})
</script>

<template>
  <section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-light mb-4">El Nostre Compromís</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
          A NiDEES, combinem artesania tradicional amb sostenibilitat per crear productes únics i respectuosos amb el medi ambient.
        </p>
      </div>

      <div class="relative">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
          <div
            v-for="(feature, index) in visibleFeatures"
            :key="index"
            class="bg-white p-8 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 h-full text-center"
          >
            <component :is="feature.icon" class="h-8 w-8 text-emerald-600 mx-auto mb-4" />
            <h3 class="text-xl font-semibold mb-3">{{ feature.title }}</h3>
            <p class="text-gray-600">{{ feature.description }}</p>
          </div>
        </div>

        <!-- Controls -->
        <button
          @click="prev"
          :disabled="!canGoPrev"
          class="absolute left-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition disabled:opacity-30"
        >
          <ChevronLeft class="w-5 h-5 text-gray-600" />
        </button>
        <button
          @click="next"
          :disabled="!canGoNext"
          class="absolute right-0 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition disabled:opacity-30"
        >
          <ChevronRight class="w-5 h-5 text-gray-600" />
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped>
button:disabled {
  cursor: not-allowed;
}
</style>