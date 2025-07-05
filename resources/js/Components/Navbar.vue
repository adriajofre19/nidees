<script setup>
import { ref } from 'vue'
import { ShoppingCart, Menu, X } from 'lucide-vue-next'
import { Link } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)
</script>

<template>
  <nav class="bg-white border-b border-gray-200">
    <div class="h-20 px-6 md:px-32 flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center gap-4">
        <img src="/images/logo.png" alt="Logo" class="h-11 w-auto" />
        <img src="/images/logo2.png" alt="Logo" class="h-8 w-auto hidden sm:block" />
      </div>

      <!-- Desktop Menu -->
      <ul class="hidden md:flex gap-6 items-center">
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
        </template>
      </ul>

      <!-- Right Side -->
      <div class="flex items-center gap-4">
        <!-- Cart -->
        <div class="relative">
  <Link href="/cart" class="text-gray-700 hover:text-emerald-600">
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
          <a href="/login"
             class="hidden md:inline text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
            Iniciar sesión
          </a>
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
          <li class="text-gray-700">Hola,  {{ $page.props.auth.user.name }}</li>
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
      </ul>
    </div>
  </nav>
</template>