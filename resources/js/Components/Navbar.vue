<script setup>
import { ref } from 'vue'
import { ShoppingCart, Menu, X } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

// Mobile & user menu
const mobileMenuOpen = ref(false)
const userMenuOpen = ref(false)

// Para el dropdown de idiomas móvil
const showLangs = ref(false)

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
  if (!mobileMenuOpen.value) userMenuOpen.value = false
}

const toggleUserMenu = () => {
  userMenuOpen.value = !userMenuOpen.value
}

// Language logic
const supportedLangs = ['ca', 'en']
const pathParts = window.location.pathname.split('/')
const currentLang = ref(supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es')

const changeLanguage = (langOrEvent) => {
  const newLang = typeof langOrEvent === 'string' ? langOrEvent : langOrEvent.target.value
  const parts = window.location.pathname.split('/')
  if (supportedLangs.includes(parts[1])) {
    parts.splice(1, 1)
  }
  if (newLang !== 'es') {
    parts.splice(1, 0, newLang)
  }
  const newPath = parts.join('/') || '/'
  currentLang.value = newLang
  // Cerrar el dropdown de idiomas móvil si estaba abierto
  showLangs.value = false
  window.location.pathname = newPath
}
</script>

<template>
  <nav class="bg-white border-b border-gray-200 fixed top-0 left-0 w-full z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <!-- Logo -->
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="/images/logo.png" class="h-10" alt="Logo 1" />
        <img src="/images/logo2.png" class="h-8" alt="Logo 2" />
      </a>

      <!-- Botones derecha -->
      <div class="flex items-center md:order-2 space-x-2 md:space-x-4 rtl:space-x-reverse relative">

        <div class="md:hidden relative">
            <button
              @click="showLangs = !showLangs"
              type="button"
              class="w-full text-left py-2 text-gray-700 hover:bg-gray-100 rounded md:hidden flex justify-between items-center"
            >
            <div>
              <img
                :src="currentLang === 'es' ? '/images/spain.png' : currentLang === 'ca' ? '/images/catalonia.webp' : '/images/reino-unido.png'"
                alt=""
                class="inline-block w-6 h-6"
              />
              
            </div>
              
              <svg
                class="w-4 h-4 ml-2"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <ul
              v-show="showLangs"
              class="absolute z-50 mt-1 bg-white border rounded shadow-md w-36"
            >
              <li>
                <button @click="changeLanguage('es')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/spain.png" alt="" class="inline-block mr-2 w-4 h-4" />
                  Español
                </button>
              </li>
              <li>
                <button @click="changeLanguage('en')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/reino-unido.png" alt="" class="inline-block mr-2 w-4 h-4" />
                  English
                </button>
              </li>
              <li>
                <button @click="changeLanguage('ca')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/catalonia.webp" alt="" class="inline-block mr-2 w-4 h-4" />
                  Català
                </button>
              </li>
            </ul>
          </div>

        <div class="hidden md:block">
          <button
              @click="showLangs = !showLangs"
              type="button"
              class="w-full text-left py-2 px-3 text-gray-700 hover:bg-gray-100 rounded hidden md:flex justify-between items-center"
            >
            <div>
              <img
                :src="currentLang === 'es' ? '/images/spain.png' : currentLang === 'ca' ? '/images/catalonia.webp' : '/images/reino-unido.png'"
                alt=""
                class="inline-block mr-2 w-4 h-4"
              />
              {{ currentLang.toUpperCase() === 'ES' ? 'Español' : currentLang.toUpperCase() === 'CA' ? 'Català' : 'English' }}
            </div>
              
              <svg
                class="w-4 h-4 ml-2"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <ul
              v-show="showLangs"
              class="absolute z-50 mt-1 bg-white border rounded shadow-md "
            >
              <li>
                <button @click="changeLanguage('es')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/spain.png" alt="" class="inline-block mr-2 w-4 h-4" />
                  Español
                </button>
              </li>
              <li>
                <button @click="changeLanguage('en')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/reino-unido.png" alt="" class="inline-block mr-2 w-4 h-4" />
                  English
                </button>
              </li>
              <li>
                <button @click="changeLanguage('ca')" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">
                  <img src="/images/catalonia.webp" alt="" class="inline-block mr-2 w-4 h-4" />
                  Català
                </button>
              </li>
            </ul>
        </div>
        

        <!-- Icono carrito -->
        <div class="relative">
          <Link :href="currentLang === 'ca' ? '/ca/cart' : currentLang === 'en' ? '/en/cart' : '/cart'" class="text-gray-700 hover:text-emerald-600">
            <div class="relative">
              <ShoppingCart class="h-6 w-6" />
              <div
                v-if="$page.props.cartCount > 0"
                class="absolute top-0 right-0 w-2.5 h-2.5 bg-emerald-600 rounded-full ring-2 ring-white"
              ></div>
            </div>
            <span
              v-if="$page.props.cartCount > 0"
              class="absolute -top-2 -right-2 bg-emerald-600 text-white text-xs font-bold rounded-full px-1.5 py-0.5"
            >
              {{ $page.props.cartCount }}
            </span>
          </Link>
        </div>

        <!-- Usuario autenticado (escritorio) -->
        <template v-if="$page.props.auth && $page.props.auth.user && !mobileMenuOpen">
          <div class="relative">
            <button
              @click="toggleUserMenu"
              type="button"
              class="hidden md:flex items-center space-x-2 text-sm focus:outline-none"
            >
              <img
                class="w-8 h-8 rounded-full"
                :src="$page.props.auth.user.avatar"
                alt="user photo"
              />
              <span class="text-gray-700 font-medium">{{ $page.props.auth.user.name }}</span>
            </button>

            <!-- Dropdown usuario escritorio -->
            <div
              v-if="userMenuOpen"
              class="absolute right-0 mt-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm z-50"
            >
              <div class="px-4 py-3">
                <span class="block text-sm text-gray-900">{{ $page.props.auth.user.name }}</span>
                <span class="block text-sm text-gray-500 truncate">{{ $page.props.auth.user.role }}</span>
              </div>
              <ul class="py-2">
                <template v-if="$page.props.auth.user">
                  <li v-if="$page.props.auth.user.role === 'admin'">
                    <Link :href="route('categories.index')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Categories</Link>
                  </li>
                  <li v-if="$page.props.auth.user.role === 'admin'">
                    <Link :href="route('products.index')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Productes</Link>
                  </li>
                </template>
                <li>
                  <Link :href="route('logout')" method="post"
                    class="w-full text-left block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                    Cerrar sesión
                  </Link>
                </li>
              </ul>
            </div>
          </div>
        </template>

        <!-- Usuario no autenticado (escritorio) -->
        <template v-if="!$page.props.auth?.user && !mobileMenuOpen">
          <Link
            :href="currentLang === 'ca' ? '/ca/login' : currentLang === 'en' ? '/en/login' : '/login'"
            class="hidden md:inline-block px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-emerald-600 to-emerald-700 rounded hover:bg-emerald-700"
          >
            {{ 
            currentLang === 'ca' ? 'Iniciar sessió' : currentLang === 'en' ? 'Log in' : 'Iniciar sesión' }}
          </Link>
        </template>

        <!-- Botón menú móvil -->
        <button
          @click="toggleMobileMenu"
          type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden"
        >
          <span class="sr-only">Open main menu</span>
          <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
          <X v-else class="w-6 h-6" />
        </button>
      </div>

      <!-- Menú principal -->
      <div :class="['items-center justify-between w-full md:flex md:w-auto md:order-1', mobileMenuOpen ? '' : 'hidden']" id="navbar-user">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">

          <!-- Links según idioma -->
          <template v-if="currentLang === 'es'">
            <li><Link href="/" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">INICIO</Link></li>
            <li><Link href="/tienda" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">TIENDA</Link></li>
            <li><Link href="/nosotros" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">NOSOTROS</Link></li>
            <li><Link href="/contact" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">CONTACTO</Link></li>
          </template>

          <template v-else-if="currentLang === 'ca'">
            <li><Link href="/ca" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">INICI</Link></li>
            <li><Link href="/ca/tienda" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">BOTIGA</Link></li>
            <li><Link href="/ca/nosotros" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">NOSALTRES</Link></li>
            <li><Link href="/ca/contact" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">CONTACTE</Link></li>
          </template>

          <template v-else-if="currentLang === 'en'">
            <li><Link href="/en" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">HOME</Link></li>
            <li><Link href="/en/tienda" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">STORE</Link></li>
            <li><Link href="/en/nosotros" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">ABOUT US</Link></li>
            <li><Link href="/en/contact" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">CONTACT</Link></li>
          </template>

          

          <!-- Usuario móvil -->
          <li class="md:hidden">
            <template v-if="$page.props.auth?.user">
              <div class="border-t mt-2 pt-2">
                <span class="block text-gray-700 font-semibold">{{ $page.props.auth.user.name }}</span>
                <span class="block text-gray-500 mb-2">{{ $page.props.auth.user.role }}</span>

                <template v-if="$page.props.auth.user.role === 'admin'">
                  <Link href="/categories" class="block py-1 text-gray-700 hover:text-emerald-600">Categories</Link>
                  <Link href="/products" class="block py-1 text-gray-700 hover:text-emerald-600">Productes</Link>
                </template>

                <Link href="/logout" method="post" class="block py-1 text-red-500 hover:text-red-700">Cerrar sesión</Link>
              </div>
            </template>
            <template v-else>
              <Link href="/login" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 rounded">Iniciar sesión</Link>
            </template>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
