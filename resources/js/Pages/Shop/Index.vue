<script setup>
import { defineProps, ref, reactive } from 'vue'
import Navbar from '@/Components/Navbar.vue'
import { Link, Head, router } from '@inertiajs/vue3'
import { ShoppingCart } from 'lucide-vue-next'
import Footer from '@/Components/Footer.vue'

const props = defineProps({
  products: Array,
  user: Array
})

import { onMounted, nextTick } from 'vue'
import gsap from 'gsap'

onMounted(async () => {
  await nextTick() // Espera a que el DOM se renderice
  gsap.from('.product-card', {
    opacity: 0,
    y: 50,
    duration: 1,
    ease: 'power2.out',
    stagger: {
      each: 0.15,
      from: 'start'
    }
  })
})



const activeImageIndexes = ref({})
const intervals = ref({})
const isAddingToCart = reactive({})

function setActiveImage(productId, idx) {
  activeImageIndexes.value[productId] = idx
}

function resetActiveImage(productId) {
  activeImageIndexes.value[productId] = 0
  if (intervals.value[productId]) {
    clearInterval(intervals.value[productId])
    intervals.value[productId] = null
  }
}

function startImageCycle(product) {
  if (!product.images || product.images.length <= 1) return
  let idx = 1
  resetActiveImage(product.id)
  intervals.value[product.id] = setInterval(() => {
    activeImageIndexes.value[product.id] = idx
    idx = (idx + 1) % product.images.length
  }, 900)
}

function stopImageCycle(productId) {
  resetActiveImage(productId)
}

// Añadir al carrito
function addToCart(productId) {
  isAddingToCart[productId] = true
  router.post(route('cart.add'), { product_id: productId }, {
    preserveScroll: true,
    onSuccess: () => {
      isAddingToCart[productId] = false
    },
    onBefore: () => {
      isAddingToCart[productId] = true
    }
  })
}

const supportedLangs = ['ca', 'en']

// Detecta el idioma actual (si está en el primer segmento)
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'


</script>

<template>
<Head :title="currentLang === 'ca' ? 'Botiga' : currentLang === 'en' ? 'Shop' : 'Tienda'" />
  <Navbar />
  <div class="max-w-7xl mx-auto px-4 py-10 mt-16">
    <h1 class="text-3xl font-bold mb-8">
      {{ currentLang === 'ca' ? 'Productes' : currentLang === 'en' ? 'Products' : 'Productos' }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 product-card">
      <Link
        v-for="product in products"
        :key="product.id"
        class=" transition overflow-hidden flex flex-col group"
        :href="currentLang === 'ca' ? `/ca/shop/${product.slug}` : currentLang === 'en' ? `/en/shop/${product.slug}` : `/shop/${product.slug}`"
      >
        <div
          class="aspect-square bg-gray-100 flex items-center justify-center relative w-full"
          @mouseenter="startImageCycle(product)"
          @mouseleave="stopImageCycle(product.id)"
        >
          <template v-if="product.images && product.images.length">
            <img
              v-for="(img, idx) in product.images"
              :key="img.id || idx"
              :src="`/public/${img.path}`"
              :alt="product.name"
              class="object-cover w-full h-full absolute inset-0 transition-opacity duration-300"
              :style="{ opacity: (activeImageIndexes[product.id] || 0) === idx ? 1 : 0 }"
            />
          </template>
          <span v-else class="text-gray-400 z-10">{{ currentLang === 'ca' ? 'Sense imatge' : currentLang === 'en' ? 'No image' : 'Sin imagen' }}</span>
        </div>
        <div class="p-4 flex-1 flex flex-col">
          <h2 class="font-semibold text-lg mb-1">{{ product.name }}</h2>
          <span class="text-gray-500 text-sm mb-2">{{ product.category?.name || 'Sense categoria' }}</span>
          <span class="font-bold text-emerald-700 text-lg">{{ product.price }} €</span>
          

          <button
            type="button"
            @click.stop.prevent="addToCart(product.id)"
            :disabled="isAddingToCart[product.id]"
            class="w-full mt-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-md hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base"
          >
            <span v-if="isAddingToCart[product.id]" class="flex items-center justify-center">
              <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              {{ currentLang === 'ca' ? 'Afegint...' : currentLang === 'en' ? 'Adding...' : 'Añadiendo...' }}
            </span>
            <span v-else class="flex items-center justify-center">
              <ShoppingCart class="w-4 h-4 sm:w-6 sm:h-6 mr-2" />
              {{ currentLang === 'ca' ? 'Afegir a la cistella' : currentLang === 'en' ? 'Add to cart' : 'Añadir a la cesta' }}
            </span>
          </button> 
        </div>
      </Link>
    </div>
  </div>
  <Footer />
</template>