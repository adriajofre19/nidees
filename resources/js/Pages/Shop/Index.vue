<script setup>
import { defineProps, ref } from 'vue'
import Navbar from '@/Components/Navbar.vue'
import { Link, Head, router } from '@inertiajs/vue3'
import { ShoppingCart } from 'lucide-vue-next'
import Footer from '@/Components/Footer.vue'

const props = defineProps({
  products: Array,
  user: Array
})

const activeImageIndexes = ref({})
const intervals = ref({})

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
  router.post(route('cart.add'), { product_id: productId }, {
    preserveScroll: true,
    onSuccess: () => {
      
    }
  })
}

const supportedLangs = ['ca', 'en']

// Detecta el idioma actual (si está en el primer segmento)
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'


</script>

<template>
<Head title="Botiga" />
  <Navbar />
  <div class="max-w-7xl mx-auto px-4 py-10 mt-16">
    <h1 class="text-3xl font-bold mb-8">
      {{ currentLang === 'ca' ? 'Productes' : currentLang === 'en' ? 'Products' : 'Productos' }}
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <Link
        v-for="product in products"
        :key="product.id"
        class="transition overflow-hidden flex flex-col group"
        :href="route('product.show', product.slug)"
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
          <span v-else class="text-gray-400 z-10">Sense imatge</span>
        </div>
        <div class="p-4 flex-1 flex flex-col">
          <h2 class="font-semibold text-lg mb-1">{{ product.name }}</h2>
          <span class="text-gray-500 text-sm mb-2">{{ product.category?.name || 'Sense categoria' }}</span>
          <span class="font-bold text-emerald-700 text-lg">{{ product.price }} €</span>
          

          <button
              
              type="button"
              @click.stop.prevent="addToCart(product.id)"
              :disabled="isAddingToCart"
              class="mt-3 w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold py-3 sm:py-3 px-4 sm:px-6 rounded-md hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base"
            >
              <span class="flex items-center justify-center">
                <ShoppingCart class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                 {{ currentLang === 'ca' ? 'Afegir a la cistella' : currentLang === 'en' ? 'Add to cart' : 'Añadir a la cesta' }}
              </span>
          </button>

         

          
        </div>
      </Link>
    </div>
  </div>
  <Footer />
</template>