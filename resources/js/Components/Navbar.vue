<script setup>
import { ref } from 'vue'
import { ShoppingCart, Menu, X } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)
const userMenuOpen = ref(false)

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
  if (!mobileMenuOpen.value) userMenuOpen.value = false
}

const toggleUserMenu = () => {
  userMenuOpen.value = !userMenuOpen.value
}

const supportedLangs = ['ca', 'en']
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'

const changeLanguage = (event) => {
  const newLang = event.target.value
  const parts = window.location.pathname.split('/')
  if (supportedLangs.includes(parts[1])) {
    parts.splice(1, 1)
  }
  if (newLang !== 'es') {
    parts.splice(1, 0, newLang)
  }
  const newPath = parts.join('/') || '/'
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

      <!-- Botons dreta -->
      <div class="flex items-center md:order-2 space-x-2 md:space-x-4 rtl:space-x-reverse relative">

        <!-- Select idioma -->
        <div class="hidden md:block">
          <select
            :value="currentLang"
            @change="changeLanguage"
            class="text-gray-700 border border-gray-300 rounded py-1 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600"
          >
            <option value="es">🇪🇸 Español</option>
            <option value="en">🇺🇸 English</option>
            <option value="ca">🇨🇦 Català</option>
          </select>
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

        <!-- Usuari autenticat (escriptori) -->
        <template v-if="$page.props.auth && $page.props.auth.user && !mobileMenuOpen">
  <div class="relative"> <!-- Contenedor relativo -->
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

    <!-- Dropdown usuari escriptori -->
    <div
      v-if="userMenuOpen"
      class="absolute right-0 mt-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm z-50"
    >
      <div class="px-4 py-3">
        <span class="block text-sm text-gray-900">{{ $page.props.auth.user.name }}</span>
        <span class="block text-sm text-gray-500 truncate">{{ $page.props.auth.user.role }}</span>
      </div>
      <ul class="py-2">
        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a></li>
        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a></li>
        <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Earnings</a></li>
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

        <!-- Usuari no autenticat (escriptori) -->
        <template v-if="!$page.props.auth?.user && !mobileMenuOpen">
          <Link
            href="/login"
            class="hidden md:inline-block px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded hover:bg-emerald-700"
          >
            Iniciar sessió
          </Link>
        </template>

        <!-- Botó menú mòbil -->
        <button
          @click="toggleMobileMenu"
          type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden"
        >
          <span class="sr-only">Open main menu</span>
          <Menu v-if="!mobileMenuOpen" class="w-6 h-6" />
          <X v-else class="w-6 h-6" />
        </button>
      </div>

      <!-- Menú principal -->
      <div :class="['items-center justify-between w-full md:flex md:w-auto md:order-1', mobileMenuOpen ? '' : 'hidden']" id="navbar-user">
        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 rounded-lg md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
          
          <!-- Links segons idioma -->
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
            <li><Link href="/en/tienda" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">SHOP</Link></li>
            <li><Link href="/en/nosotros" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">US</Link></li>
            <li><Link href="/en/contact" class="block py-2 px-3 text-gray-700 hover:bg-gray-100 md:hover:bg-transparent md:hover:text-emerald-600 md:p-0">CONTACT</Link></li>
          </template>

          <!-- Select idioma també al menú mòbil -->
          <li class="md:hidden mt-2">
            <select
              :value="currentLang"
              @change="changeLanguage"
              class="text-gray-700 border border-gray-300 rounded py-1 px-2 text-sm w-full focus:outline-none focus:ring-2 focus:ring-emerald-600"
            >
              <option value="es">🇪🇸 Español</option>
              <option value="en">🇺🇸 English</option>
              <option value="ca">🇨🇦 Català</option>
            </select>
          </li>

          <!-- Usuari o login al menú mòbil -->
          <li class="md:hidden mt-2">
            <template v-if="$page.props.auth && $page.props.auth.user">
              <!-- Botó usuari mòbil sense dropdown -->
              <button
                @click="toggleUserMenu"
                type="button"
                class="flex items-center space-x-2 w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded"
              >
                <img
                  class="w-8 h-8 rounded-full"
                  :src="$page.props.auth.user.avatar"
                  alt="user photo"
                />
                <span>{{ $page.props.auth.user.name }}</span>
              </button>
              <!-- Mostrar directament l'opció Cerrar sesión sota el botó -->
              <Link
                :href="route('logout')"
                method="post"
                class="block w-full px-4 py-2 text-left text-red-500 hover:bg-gray-100 rounded"
              >
                Cerrar sesión
              </Link>
            </template>
            <template v-else>
              <Link
                href="/login"
                class="block w-full px-4 py-2 text-center text-gray-700 rounded hover:bg-gray-100"
              >
                Iniciar sessió
              </Link>
            </template>
          </li>
        </ul>

        <!-- Dropdown usuari escriptori -->
        
      </div>
    </div>
  </nav>
</template>
