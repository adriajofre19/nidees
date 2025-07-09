<template>
  <Head :title="product.name" />
  <Navbar />
  
  <div class="min-h-screen mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-12">
      <!-- Breadcrumb -->
      <div class="mb-4 sm:mb-6">
        <Link 
          :href="route('shop.index')" 
          class="inline-flex items-center text-sm text-gray-500 hover:text-emerald-600 transition-colors duration-200"
        >
        {{ 
          currentLang === 'ca' ? '← Tornar a la botiga' : currentLang === 'en' ? '← Go back to the store' : '← Volver a la tienda'
        }}
          
        </Link>
      </div>

      <!-- Contenido principal del producto -->
      <div class="bg-white rounded-xl sm:rounded-2xl overflow-hidden ">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12">
          <!-- Galería de imágenes -->
          <div class="p-4 sm:p-6 lg:p-8">
            <!-- Imagen principal -->
            <div class="relative aspect-square overflow-hidden rounded-xl sm:rounded-2xl bg-gray-100 mb-4 sm:mb-6">
              <img
                :src="selectedImage"
                :alt="product.name"
                class="w-full h-full object-cover transition-all duration-500"
              />
              
              <!-- Indicador de imagen actual -->
              <div 
                v-if="images.length > 1"
                class="absolute top-4 right-4 bg-black/50 text-white px-2 py-1 rounded-full text-xs sm:text-sm"
              >
                {{ currentImageIndex + 1 }} / {{ images.length }}
              </div>
            </div>
            
            <!-- Miniaturas -->
            <div v-if="images.length > 1" class="flex space-x-2 sm:space-x-3 overflow-x-auto pb-2">
              <img
                v-for="(image, i) in images"
                :key="i"
                :src="image"
                @click="selectImage(image, i)"
                class="w-16 h-16 sm:w-20 sm:h-20 object-cover border-2 rounded-lg cursor-pointer transition-all duration-200 flex-shrink-0"
                :class="{ 
                  'ring-3 ring-emerald-600 border-emerald-600': selectedImage === image,
                  'border-gray-200 hover:border-emerald-300': selectedImage !== image
                }"
              />
            </div>
          </div>

          <!-- Información del producto -->
          <div class="p-4 sm:p-6 lg:p-8 flex flex-col justify-between">
            <div class="space-y-4 sm:space-y-6">
              <!-- Categoría -->
              <div v-if="product.category">
                <span class="inline-block bg-emerald-100 text-emerald-800 text-xs sm:text-sm font-medium px-3 py-1 rounded-full">
                  {{ product.category.name }}
                </span>
              </div>

              <!-- Título y precio -->
              <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-3 sm:mb-4">
                  {{ product.name }}
                </h1>
                <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-emerald-600">
                  {{ formatPrice(product.price) }}€
                </p>
              </div>

              <!-- Separador -->
              <hr class="border-gray-200" />

              <!-- Descripción -->
              <div>
                <h2 class="font-semibold text-lg sm:text-xl text-gray-900 mb-3 sm:mb-4">
                  
                  {{ 
                      currentLang === 'ca' ? 'Detalls del producte' : currentLang === 'en' ? 'Product details' : 'Detalles del producto'
                  }}
                </h2>
                <div 
                  class="text-gray-700 text-sm sm:text-base leading-relaxed whitespace-pre-line"
                  v-html="product.description"
                ></div>
              </div>
            </div>

            <!-- Botón añadir al carrito -->
            <div class="mt-6 sm:mt-8">
              <button
                @click="addToCart(product.id)"
                :disabled="isAddingToCart"
                class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-xl hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base"
              >
                <span v-if="isAddingToCart" class="flex items-center justify-center">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Afegint...
                </span>
                <span v-else class="flex items-center justify-center">
                  <ShoppingCart class="w-4 h-4 sm:w-5 sm:h-5 mr-2" />
                  {{ currentLang === 'ca' ? 'Afegir a la cistella' : currentLang === 'en' ? 'Add to cart' : 'Añadir a la cesta' }}
                </span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Productos relacionados -->
      <div v-if="relatedProducts && relatedProducts.length > 0" class="mt-12 sm:mt-16">
        <div class="mb-6 sm:mb-8">
          <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
            Productes relacionats
          </h2>
          <p class="text-gray-600 text-sm sm:text-base">
            Altres productes que et poden interessar
          </p>
        </div>

        <!-- Grid de productos relacionados -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
          <Link
            v-for="related in relatedProducts"
            :key="related.id"
            :href="route('product.show', related.slug)"
            class="bg-white overflow-hidden transition-all duration-300 transform hover:scale-[1.02] group"
            @mouseenter="startImageCycle(related)"
            @mouseleave="stopImageCycle(related.id)"
          >
            <!-- Imagen del producto relacionado -->
            <div class="aspect-square bg-gray-100 flex items-center justify-center relative w-full overflow-hidden">
              <template v-if="related.images && related.images.length">
                <img
                  v-for="(img, idx) in related.images"
                  :key="img.id || idx"
                  :src="`/public/${img.path}`"
                  :alt="related.name"
                  class="object-cover w-full h-full absolute inset-0 transition-opacity duration-500"
                  :style="{ opacity: (activeImageIndexes[related.id] || 0) === idx ? 1 : 0 }"
                />
                
                <!-- Indicadores de imágenes -->
                <div 
                  v-if="related.images.length > 1"
                  class="absolute bottom-2 sm:bottom-3 left-1/2 transform -translate-x-1/2 flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                >
                  <div
                    v-for="(img, idx) in related.images"
                    :key="`indicator-${idx}`"
                    class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full transition-colors duration-300"
                    :class="(activeImageIndexes[related.id] || 0) === idx ? 'bg-white' : 'bg-white/50'"
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

            <!-- Información del producto relacionado -->
            <div class="p-3 sm:p-4 lg:p-6">
              <!-- Categoría -->
              <div class="mb-2">
                <span class="inline-block text-gray-600 text-sm font-medium py-1">
                  {{ related.category?.name || 'Sense categoria' }}
                </span>
              </div>
              
              <!-- Nombre -->
              <h3 class="font-semibold text-base sm:text-lg text-gray-900 mb-2 transition-colors duration-200">
                {{ related.name }}
              </h3>
              
              <!-- Precio -->
              <div>
                <span class="font-bold text-lg sm:text-xl text-emerald-600">
                  {{ formatPrice(related.price) }}€
                </span>
              </div>
            </div>
          </Link>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import { ref, defineProps, onMounted, onBeforeUnmount, computed } from 'vue'
import { Link, Head, router } from '@inertiajs/vue3'
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import { ShoppingCart } from 'lucide-vue-next'

const props = defineProps({
  product: Object,
  relatedProducts: Array
})

// Estados reactivos
const images = props.product.images?.map(img => `/public/${img.path}`) || []
const selectedImage = ref(images[0] || '/placeholder.jpg')
const currentImageIndex = ref(0)
const isAddingToCart = ref(false)
const activeImageIndexes = ref({})
const intervals = ref({})

let autoSlideInterval = null

// Función helper para formatear precios
function formatPrice(price) {
  const numPrice = typeof price === 'string' ? parseFloat(price) : price
  return isNaN(numPrice) ? 0 : numPrice.toFixed(2)
}

// Seleccionar imagen
function selectImage(image, index) {
  selectedImage.value = image
  currentImageIndex.value = index
  // Reiniciar el carrusel automático
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval)
    startAutoSlide()
  }
}

// Carrusel automático
function startAutoSlide() {
  if (images.length <= 1) return
  
  autoSlideInterval = setInterval(() => {
    currentImageIndex.value = (currentImageIndex.value + 1) % images.length
    selectedImage.value = images[currentImageIndex.value]
  }, 5000)
}

// Funciones para productos relacionados
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
  isAddingToCart.value = true
  
  router.post(route('cart.add'), { product_id: productId }, {
    preserveScroll: true,
    onSuccess: () => {
      isAddingToCart.value = false
      // Opcional: mostrar notificación de éxito
    },
    onError: () => {
      isAddingToCart.value = false
      // Opcional: mostrar notificación de error
    }
  })
}

// Lifecycle hooks
onMounted(() => {
  startAutoSlide()
})

onBeforeUnmount(() => {
  if (autoSlideInterval) {
    clearInterval(autoSlideInterval)
  }
  // Limpiar intervalos de productos relacionados
  Object.values(intervals.value).forEach(interval => {
    if (interval) clearInterval(interval)
  })
})

const supportedLangs = ['ca', 'en']

// Detecta el idioma actual (si está en el primer segmento)
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'
</script>