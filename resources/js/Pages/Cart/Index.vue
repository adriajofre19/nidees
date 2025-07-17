<template>
  <Head title="Cistella" />
  <Navbar />
  
  <div class="min-h-screen mt-16">
    <div class="max-w-7xl mx-auto py-6 sm:py-8 lg:py-12 px-4 sm:px-6 lg:px-8">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
        <!-- Columna principal del carrito -->
        <div class="lg:col-span-7">
          <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8">
            <!-- Header responsive -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 lg:mb-8 gap-3 sm:gap-0">
              <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                {{ currentLang === 'ca' ? 'Cistella' : currentLang === 'en' ? 'Cart' : 'Carrito' }}
              </h1>
              <div class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm font-medium self-start sm:self-auto">
                {{ cartItems.length }} {{ cartItems.length === 1 ? 'artículo' : 'articulos' }}
              </div>
            </div>

            <!-- Estado vacío mejorado -->
            <div v-if="cartItems.length === 0" class="text-center py-12 sm:py-16">
              <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 sm:mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
              </div>
              <h3 class="text-lg sm:text-xl font-medium text-gray-900 mb-2 truncate">
                {{ currentLang === 'ca' ? 'El teu carret està buit' : currentLang === 'en' ? 'Your cart is empty' : 'Tu carrito está vacío' }}
              </h3>

              <p class="text-gray-500 mb-6 sm:mb-8 text-sm sm:text-base px-4">
                {{ currentLang === 'ca' ? 'Descobreix els nostres productes i afegeix-los al carret' : currentLang === 'en' ? 'Explore our products and add them to your cart' : 'Descubre nuestros productos y añádelos a tu carrito' }}
              </p>
              <Link
                :href="currentLang === 'ca' ? '/ca/tienda' : currentLang === 'en' ? '/en/tienda' : '/tienda'"
                class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 bg-emerald-600 text-white font-medium rounded-xl hover:bg-emerald-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base"
              >
                
                {{ 
                  currentLang === 'ca'
                    ? 'Explora la botiga'
                    : currentLang === 'en'
                    ? 'Explore the shop'
                    : 'Explora la tienda'
                }}
              </Link>
            </div>

            <!-- Lista de productos responsive -->
            <div v-else class="space-y-4 sm:space-y-6">
              <transition-group name="cart-item" tag="div">
                <div
                  v-for="item in cartItems"
                  :key="item.id"
                  class="rounded-xl p-4 sm:p-6 transition-all duration-300 transform hover:scale-[1.01] sm:hover:scale-[1.02]"
                >
                  <!-- Layout móvil: vertical -->
                  <div class="block sm:hidden">
                    <!-- Imagen y título -->
                    <div class="flex items-start space-x-4 mb-4">
                      <div class="flex-shrink-0">
                        <img
                          :src="item.product.images[0] ? `/public/${item.product.images[0].path}` : '/placeholder.jpg'"
                          :alt="item.product.name"
                          class="w-20 h-20 object-cover rounded-lg shadow-md"
                        />
                      </div>
                      <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-2">
                          {{ item.product.name }}
                        </h3>
                        <p class="text-lg font-bold text-emerald-600">
                          {{ formatPrice(item.product.price).toFixed(2) }}€
                        </p>
                      </div>
                      <!-- Botón eliminar móvil -->
                      <button
                        @click="remove(item)"
                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200"
                      >
                        <Trash2 class="w-5 h-5" />
                      </button>
                    </div>
                    
                    <!-- Controles y precio total móvil -->
                    <div class="flex items-center justify-between">
                      <!-- Controles de cantidad -->
                      <div class="flex items-center space-x-2">
                        <button
                          @click="decrement(item)"
                          :disabled="item.quantity <= 1"
                          class="w-9 h-9 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                          <span class="text-base font-bold">−</span>
                        </button>
                        
                        <div class="bg-white px-3 py-1 rounded-lg border-2 border-gray-200 min-w-[2.5rem] text-center">
                          <span class="text-base font-semibold text-gray-900">{{ item.quantity }}</span>
                        </div>
                        
                        <button
                          @click="increment(item)"
                          class="w-9 h-9 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-colors duration-200"
                        >
                          <span class="text-base font-bold">+</span>
                        </button>
                      </div>
                      
                      <!-- Precio total móvil -->
                      <div class="text-right">
                        <p class="text-lg font-bold text-gray-900">
                          {{ (item.quantity * formatPrice(item.product.price)).toFixed(2) }}€
                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Layout desktop: horizontal -->
                  <div class="hidden sm:flex sm:items-center sm:space-x-6">
                    <!-- Imagen del producto -->
                    <Link  
                    :href="currentLang === 'ca' ? `/ca/shop/${item.product.slug}` : currentLang === 'en' ? `/en/shop/${item.product.slug}` : `/shop/${item.product.slug}`"
                    class="flex-shrink-0">
                      <img
                        :src="item.product.images[0] ? `/public/${item.product.images[0].path}` : '/placeholder.jpg'"
                        :alt="item.product.name"
                        class="w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32 object-cover rounded-xl shadow-md"
                      />
                    </Link>
                    
                    <!-- Información del producto -->
                    <Link 
                    :href="currentLang === 'ca' ? `/ca/shop/${item.product.slug}` : currentLang === 'en' ? `/en/shop/${item.product.slug}` : `/shop/${item.product.slug}`"
                    class="flex-1 min-w-0">
                      <h3 class="text-lg lg:text-lg font-semibold text-gray-900 truncate">
                        {{ item.product.name }}
                      </h3>
                      <p class="text-xl lg:text-lg font-bold text-emerald-600 mt-1">
                        {{ formatPrice(item.product.price).toFixed(2) }}€
                      </p>
                    </Link>
                    
                    <!-- Controles de cantidad -->
                    <div class="flex items-center space-x-3">
                      <button
                        @click="decrement(item)"
                        :disabled="item.quantity <= 1"
                        class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                      >
                        <span class="text-lg font-bold">−</span>
                      </button>
                      
                      <div class="bg-white px-4 py-2 rounded-lg border-2 border-gray-200 min-w-[3rem] text-center">
                        <span class="text-lg font-semibold text-gray-900">{{ item.quantity }}</span>
                      </div>
                      
                      <button
                        @click="increment(item)"
                        class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-colors duration-200"
                      >
                        <span class="text-lg font-bold">+</span>
                      </button>
                    </div>
                    
                    <!-- Precio total del item -->
                    <div class="text-right">
                      <p class="text-lg lg:text-xl font-bold text-gray-900">
                        {{ (item.quantity * formatPrice(item.product.price)).toFixed(2) }}€
                      </p>
                    </div>
                    
                    <!-- Botón eliminar -->
                    <button
                      @click="remove(item)"
                      class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-200"
                      aria-label="Eliminar article del carret"
                    >
                      <Trash2 class="w-5 h-5" />
                    </button>
                  </div>
                </div>
              </transition-group>

              <!-- Botón continuar comprando -->
              <div class="pt-4 sm:pt-6 border-t border-gray-200">
                <Link
                  :href="currentLang === 'ca' ? '/ca/tienda' : currentLang === 'en' ? '/en/tienda' : '/tienda'"
                  class="inline-flex items-center px-4 sm:px-6 py-2 sm:py-3 border-2 border-emerald-600 text-emerald-600 font-medium rounded-xl hover:bg-emerald-50 transition-all duration-200 transform hover:scale-105 text-sm sm:text-base"
                >
                  
                  {{ 
                    currentLang === 'ca' ? '← Continuar Comprant' : currentLang === 'en' ? '← Continue Shopping' : '← Seguir Comprando'
                  }}
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Resumen del pedido responsive -->
        <div class="mt-8 lg:mt-0 lg:col-span-5">
          <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 lg:sticky lg:top-8">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">
              {{ currentLang === 'ca' ? 'Resum de la Comanda' : currentLang === 'en' ? 'Order Summary' : 'Resumen del Pedido' }}
            </h2>
            
            <div class="space-y-3 sm:space-y-4">
              <div class="flex justify-between items-center py-2">
                <span class="text-gray-600 text-sm sm:text-base">
                  {{ currentLang === 'ca' ? 'Subtotal' : currentLang === 'en' ? 'Subtotal' : 'Subtotal' }}
                </span>
                <span class="text-base sm:text-lg font-semibold text-gray-900">{{ subtotal.toFixed(2) }}€</span>
              </div>
              
              <div class="flex justify-between items-center py-2">
                <span class="text-gray-600 text-sm sm:text-base">
                  {{ currentLang === 'ca' ? 'Enviament' : currentLang === 'en' ? 'Shipping' : 'Envío' }}
                </span>
                <span class="text-emerald-600 font-semibold text-sm sm:text-base">Gratuït</span>
              </div>
              
              <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center">
                  <span class="text-lg sm:text-xl font-bold text-gray-900">Total</span>
                  <span class="text-xl sm:text-2xl font-bold text-emerald-600">{{ subtotal.toFixed(2) }}€</span>
                </div>
              </div>
            </div>

            <!-- Información de envío -->
            <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-emerald-50 rounded-xl">
              <div class="flex items-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-xs sm:text-sm text-emerald-800 font-medium">
                  
                  {{ 
                    currentLang === 'ca'
                      ? 'Enviament gratuït a tota la península'
                      : currentLang === 'en'
                      ? 'Free shipping to the peninsula'
                      : 'Envío gratuito a toda la península'
                  }}
                </span>
              </div>
            </div>

            

            <button
              :disabled="cartItems.length === 0 || isLoading"
              @click="checkout"
              :class="[
                'mt-6 sm:mt-8 w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-xl hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl text-sm sm:text-base',
                isLoading ? 'opacity-70 cursor-wait' : '',
                cartItems.length === 0 ? 'disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none' : ''
              ]"
            >
              <span v-if="!isLoading">
                {{ currentLang === 'ca' ? 'Tramitar Comanda' : currentLang === 'en' ? 'Checkout' : 'Tramitar Pedido' }}
              </span>
              <span v-else class="flex justify-center items-center">
                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                </svg>
                {{ currentLang === 'ca' ? 'Processant...' : currentLang === 'en' ? 'Processing...' : 'Procesando...' }}
              </span>
            </button>



            <!-- Información adicional -->
            <div class="mt-4 sm:mt-6 text-center">
              <div class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-6 text-xs sm:text-sm text-gray-500">
                <div class="flex items-center">
                  <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                  </svg>
                  {{ currentLang === 'ca' ? 'Pagament segur' : currentLang === 'en' ? 'Secure Payment' : 'Pago seguro' }}
                </div>
                <div class="flex items-center">
                  <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                  </svg>
                  {{ currentLang === 'ca' ? 'Devolucions fàcils' : currentLang === 'en' ? 'Easy Returns' : 'Devoluciones fáciles' }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import { ref, computed } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { Trash2, ArrowLeft } from 'lucide-vue-next'
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'


const props = defineProps({
  items: Array
})


// Función helper para formatear precios
function formatPrice(price) {
  const numPrice = typeof price === 'string' ? parseFloat(price) : price
  return isNaN(numPrice) ? 0 : numPrice
}

// Còpia reactiva dels ítems del carret
const cartItems = ref([...props.items])

// Subtotal automàticament actualitzat
const subtotal = computed(() =>
  cartItems.value.reduce(
    (total, item) => total + item.quantity * formatPrice(item.product.price),
    0
  )
)

// Funciones d'interacció amb el carret
function increment(item) {
  router.post(`/cart/increment/${item.id}`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      const i = cartItems.value.find(i => i.id === item.id)
      if (i) i.quantity++
    }
  })
}

function decrement(item) {
  if (item.quantity > 1) {
    router.post(`/cart/decrement/${item.id}`, {}, {
      preserveScroll: true,
      onSuccess: () => {
        const i = cartItems.value.find(i => i.id === item.id)
        if (i) i.quantity--
      }
    })
  }
}

function remove(item) {
  router.delete(`/cart/remove/${item.id}`, {
    preserveScroll: true,
    onSuccess: () => {
      cartItems.value = cartItems.value.filter(i => i.id !== item.id)
    }
  })
}
const isLoading = ref(false)

async function checkout() {
  try {
    isLoading.value = true
    const itemsToSend = cartItems.value.map(item => {
      // Si no té imatge, posar una imatge per defecte (p. ex. un placeholder)
      const imageUrl = item.product.images && item.product.images.length > 0
        ? `https://nidees.com/public/${item.product.images[0].path}`
        : 'https://nidees.com/default-image.jpg' // Canvia això per una imatge vàlida per defecte

      return {
        name: item.product.name,
        price: item.product.price,
        quantity: item.quantity,
        image: imageUrl,
      }
    })

    console.log('Items enviats:', itemsToSend)

    const response = await axios.post('/checkout', { items: itemsToSend })

    window.location.href = response.data.url
  } catch (error) {
    console.error('Error al crear la sessió de Stripe:', error)
  } finally {
    isLoading.value = false
  }
}

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'


</script>

<style scoped>
.cart-item-enter-active,
.cart-item-leave-active {
  transition: all 0.5s ease;
}

.cart-item-enter-from {
  opacity: 0;
  transform: translateX(-30px);
}

.cart-item-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

.cart-item-leave-active {
  position: absolute;
  width: 100%;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>