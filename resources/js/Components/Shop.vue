<template>
  <Head title="Botiga" />
  <Navbar />
  
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
      <!-- Header de la tienda responsive -->
      <div class="mb-6 sm:mb-8 lg:mb-12">
        <div class="text-left">
          <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Botiga</h1>
          <p class="text-gray-600 text-sm sm:text-base">Descobreix la nostra col·lecció de productes</p>
        </div>
        
        <!-- Información adicional responsive -->
        <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
          <div class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-medium self-start sm:self-auto">
            {{ products.length }} {{ products.length === 1 ? 'producte' : 'productes' }} disponibles
          </div>
          
          <!-- Información de envío -->
          <div class="flex items-center text-xs sm:text-sm text-gray-600">
            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            Enviament gratuït a partir de 100€
          </div>
        </div>
      </div>

      <!-- Grid de productos responsive -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
        <div
          v-for="product in products"
          :key="product.id"
          class="bg-white rounded-xl sm:rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] group"
        >
          <!-- Imagen del producto -->
          <Link
            :href="route('product.show', product.slug)"
            class="block relative"
          >
            <div
              class="aspect-square bg-gray-100 flex items-center justify-center relative w-full overflow-hidden"
              @mouseenter="startImageCycle(product)"
              @mouseleave="stopImageCycle(product.id)"
            >
              <template v-if="product.images && product.images.length">
                <img
                  v-for="(img, idx) in product.images"
                  :key="img.id || idx"
                  :src="`/storage/${img.path}`"
                  :alt="product.name"
                  class="object-cover w-full h-full absolute inset-0 transition-opacity duration-500"
                  :style="{ opacity: (activeImageIndexes[product.id] || 0) === idx ? 1 : 0 }"
                />
                
                <!-- Indicadores de imágenes -->
                <div 
                  v-if="product.images.length > 1"
                  class="absolute bottom-2 sm:bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                >
                  <div
                    v-for="(img, idx) in product.images"
                    :key="`indicator-${idx}`"
                    class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-colors duration-300"
                    :class="(activeImageIndexes[product.id] || 0) === idx ? 'bg-white' : 'bg-white/50'"
                  ></div>
                </div>
              </template>
              
              <div v-else class="flex flex-col items-center justify-center text-gray-400">
                <svg class="w-8 h-8 sm:w-12 sm:h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-xs sm:text-sm">Sense imatge</span>
              </div>
            </div>
          </Link>

          <!-- Información del producto -->
          <div class="p-3 sm:p-4 lg:p-6">
            <Link :href="route('product.show', product.slug)" class="block">
              <!-- Categoría -->
              
              
              <!-- Nombre del producto -->
              <h2 class="font-semibold text-base sm:text-lg lg:text-xl text-gray-900 mb-2">
                {{ product.name }}
              </h2>

              <div class="mb-2">
                <span class="inline-block text-gray-600 text-sm font-medium py-1 rounded-full">
                  {{ product.category?.name || 'Sense categoria' }}
                </span>
              </div>
              
              <!-- Precio -->
              <div class="mb-3 sm:mb-4">
                <span class="font-bold text-lg sm:text-xl lg:text-2xl text-emerald-600">
                  {{ formatPrice(product.price) }}€
                </span>
              </div>

              
            </Link>

            <!-- Botón añadir al carrito -->
            <button
              type="button"
              @click.stop.prevent="addToCart(product.id)"
              :disabled="isAddingToCart[product.id]"
              class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-semibold py-2 sm:py-3 px-3 sm:px-4 rounded-xl hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-xs sm:text-sm lg:text-base"
            >
              <span v-if="isAddingToCart[product.id]" class="flex items-center justify-center">
                <svg class="animate-spin -ml-1 mr-2 h-3 w-3 sm:h-4 sm:w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Afegint...
              </span>
              <span v-else class="flex items-center justify-center">
                <ShoppingCart class="w-5 h-5 mr-2" />
                Afegir al carret
              </span>
            </button>
          </div>
        </div>
      </div>

      <!-- Estado vacío -->
      <div v-if="products.length === 0" class="text-center py-12 sm:py-16">
        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 sm:mb-6 bg-gray-100 rounded-full flex items-center justify-center">
          <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
        </div>
        <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-2">No hi ha productes disponibles</h3>
        <p class="text-gray-500 text-sm sm:text-base">Torneu més tard per veure les novetats</p>
      </div>

      <!-- Información adicional al final -->
      <div class="mt-12 sm:mt-16 bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 text-center">
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-full flex items-center justify-center mb-2 sm:mb-3">
              <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Enviament Ràpid</h3>
            <p class="text-xs sm:text-sm text-gray-600">Lliurament en 24-48h</p>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-full flex items-center justify-center mb-2 sm:mb-3">
              <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Pagament Segur</h3>
            <p class="text-xs sm:text-sm text-gray-600">Transaccions protegides</p>
          </div>
          
          <div class="flex flex-col items-center">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-100 rounded-full flex items-center justify-center mb-2 sm:mb-3">
              <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">Garantia de Qualitat</h3>
            <p class="text-xs sm:text-sm text-gray-600">Productes verificats</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue'
import Navbar from '@/Components/Navbar.vue'
import { Link, Head, router } from '@inertiajs/vue3';
import { ShoppingCart } from 'lucide-vue-next'

const props = defineProps({
  products: Array,
})

const activeImageIndexes = ref({})
const intervals = ref({})
const isAddingToCart = ref({})

// Función helper para formatear precios
function formatPrice(price) {
  const numPrice = typeof price === 'string' ? parseFloat(price) : price
  return isNaN(numPrice) ? 0 : numPrice.toFixed(2)
}

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
  isAddingToCart.value[productId] = true
  
  router.post(route('cart.add'), { product_id: productId }, {
    preserveScroll: true,
    onSuccess: () => {
      isAddingToCart.value[productId] = false
      // Opcional: mostrar notificación de éxito
    },
    onError: () => {
      isAddingToCart.value[productId] = false
      // Opcional: mostrar notificación de error
    }
  })
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>