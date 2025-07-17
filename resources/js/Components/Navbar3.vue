<script setup>
import { ref } from 'vue'
import { ShoppingCart, Menu, X } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)

// Idiomas soportados
const supportedLangs = ['ca', 'en']

// Detecta el idioma actual (si está en el primer segmento)
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'

const changeLanguage = (event) => {
  const newLang = event.target.value
  const parts = window.location.pathname.split('/')

  // Elimina el idioma si está presente en la URL
  if (supportedLangs.includes(parts[1])) {
    parts.splice(1, 1)
  }

  // Si se elige un idioma diferente a 'es', lo añadimos al principio
  if (newLang !== 'es') {
    parts.splice(1, 0, newLang)
  }

  const newPath = parts.join('/') || '/'
  window.location.pathname = newPath
}
</script>


<template>
  <nav class="bg-white border-b border-gray-200 fixed top-0 left-0 w-full z-50">
    <div class="h-20 px-6 md:px-32 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-4">
        <img src="/images/logo.webp" alt="Logo" class="h-11 w-auto" />
        <img src="/images/logo2.webp" alt="Logo" class="h-8 w-auto hidden sm:block" />
      </div>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex gap-6 items-center">
        <template v-if="currentLang === 'es'">
          <li><Link href="/" class="text-gray-700 hover:text-emerald-600">INICIO</Link></li>
          <li><Link href="/tienda" class="text-gray-700 hover:text-emerald-600">TIENDA</Link></li>
          <li><Link href="/nosotros" class="text-gray-700 hover:text-emerald-600">NOSOTROS</Link></li>
          <li><Link href="/contact" class="text-gray-700 hover:text-emerald-600">CONTACTO</Link></li>
        </template>

        <template v-else-if="currentLang === 'ca'">
          <li><Link href="/ca" class="text-gray-700 hover:text-emerald-600">INICI</Link></li>
          <li><Link href="/ca/tienda" class="text-gray-700 hover:text-emerald-600">BOTIGA</Link></li>
          <li><Link href="/ca/nosotros" class="text-gray-700 hover:text-emerald-600">NOSALTRES</Link></li>
          <li><Link href="/ca/contact" class="text-gray-700 hover:text-emerald-600">CONTACTE</Link></li>
        </template>

        <template v-else-if="currentLang === 'en'">
          <li><Link href="/en" class="text-gray-700 hover:text-emerald-600">HOME</Link></li>
          <li><Link href="/en/tienda" class="text-gray-700 hover:text-emerald-600">SHOP</Link></li>
          <li><Link href="/en/nosotros" class="text-gray-700 hover:text-emerald-600">US</Link></li>
          <li><Link href="/en/contact" class="text-gray-700 hover:text-emerald-600">CONTACT</Link></li>
        </template>

        <template v-if="$page.props.auth.user">
          <li v-if="$page.props.auth.user.role === 'admin'">
            <Link :href="route('categories.index')" class="text-gray-700 hover:text-emerald-600">CATEGORIES</Link>
          </li>
          <li v-if="$page.props.auth.user.role === 'admin'">
            <Link :href="route('products.index')" class="text-gray-700 hover:text-emerald-600">PRODUCTES</Link>
          </li>
        </template>

        <li>
          <select
            :value="currentLang"
            @change="changeLanguage"
            class="text-gray-700 border border-gray-300 rounded  py-1 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 w-full"
          >
            <option value="es">🇪🇸 Español</option>
            <option value="en">🇺🇸 English</option>
            <option value="ca">🇨🇦 Català</option>
          </select>
        </li>
      </ul>

      <!-- Right Side -->
      <div class="flex items-center gap-4">
        <!-- Cart -->
        <div class="relative">
          <Link :href="currentLang === 'ca' ? '/ca/cart' : currentLang === 'en' ? '/en/cart' : '/cart'" class="text-gray-700 hover:text-emerald-600">
            <div class="relative">
              <ShoppingCart class="h-6 w-6" />
              <div
                v-if="$page.props.cartCount > 0"
                class="absolute top-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full ring-2 ring-white"
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

      

        <!-- User/Auth -->
        <template v-if="$page.props.auth.user">
          <span class="text-gray-700 hidden md:block">Hola, {{ $page.props.auth.user.name }}</span>
          <Link :href="route('logout')" method="post"
                class="hidden md:inline text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
            Cerrar sesión
          </Link>
        </template>
        <template v-else>
          <Link :href="currentLang === 'ca' ? '/ca/login' : currentLang === 'en' ? '/en/login' : '/login'"
             class="hidden md:inline text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
            {{ currentLang === 'ca' ? 'Iniciar sessió' : currentLang === 'en' ? 'Log In' : 'Iniciar sesión' }}
          </Link>

        </template>

        <!-- Hamburger -->
        <button class="md:hidden" @click="mobileMenuOpen = !mobileMenuOpen">
          <component :is="mobileMenuOpen ? X : Menu" class="w-6 h-6 text-gray-700" />
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div v-if="mobileMenuOpen" class="md:hidden px-6 pb-4">
      <ul class="flex flex-col gap-4">
        <li><Link href="/" class="text-gray-700 hover:text-emerald-600">INICIO</Link></li>
        <li><Link :href="route('shop.index')" class="text-gray-700 hover:text-emerald-600">TIENDA</Link></li>
        <li><Link href="/nosotros" class="text-gray-700 hover:text-emerald-600">NOSOTROS</Link></li>

        <template v-if="$page.props.auth.user">
          <li v-if="$page.props.auth.user.role === 'admin'">
            <Link :href="route('categories.index')" class="text-gray-700 hover:text-emerald-600">CATEGORIES</Link>
          </li>
          <li v-if="$page.props.auth.user.role === 'admin'">
            <Link :href="route('products.index')" class="text-gray-700 hover:text-emerald-600">PRODUCTES</Link>
          </li>
          <li class="text-gray-700">Hola, {{ $page.props.auth.user.name }}</li>
          <li>
            <Link :href="route('logout')" method="post"
                  class="text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
              Cerrar sesión
            </Link>
          </li>
        </template>
        <template v-else>
          <li>
            <a href="/login"
               class="text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
              Iniciar sesión
            </a>
          </li>
        </template>

        <!-- Language Selector (Mobile) -->
        <li>
          <select
            :value="currentLang"
            @change="changeLanguage"
            class="text-gray-700 border border-gray-300 rounded  py-1 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-600 w-full"
          >
            <option value="es">🇪🇸 Español</option>
            <option value="en">🇺🇸 English</option>
            <option value="ca">🇨🇦 Català</option>
          </select>
        </li>
      </ul>
    </div>
  </nav>
</template>
