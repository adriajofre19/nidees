<script setup>
    import { ShoppingCart } from 'lucide-vue-next'
    import { Link } from '@inertiajs/vue3';
</script>
<template>
  <nav class="bg-white h-20 border-b border-gray-200 flex items-center justify-between px-32">
    <!-- Logo -->
    <div class="w-1/5 h-full flex items-center justify-center gap-6">
      <img src="/images/logo.png" alt="Logo" class="h-11 w-auto" />
      <img src="/images/logo2.png" alt="Logo" class="h-8 w-auto" />
    </div>

    <!-- Navegació -->
    <div class="w-3/5 h-full">
      <ul class="flex items-center justify-center gap-6 h-full">
        <li class="h-full flex items-center justify-center">
          <Link href="/" class="text-gray-700 hover:text-emerald-600 h-full flex items-center justify-center">INICIO</Link>
        </li>
        <li class="h-full flex items-center justify-center">
          <Link href="/tienda" class="text-gray-700 hover:text-emerald-600 h-full flex items-center justify-center">TIENDA</Link>
        </li>
        <li class="h-full flex items-center justify-center">
          <Link href="/nosotros" class="text-gray-700 hover:text-emerald-600 h-full flex items-center justify-center">NOSOTROS</Link>
        </li>
        <template v-if="$page.props.auth.user">
        <li v-if="$page.props.auth.user.role === 'admin'" class="h-full flex items-center justify-center">
          <Link :href="route('categories.index')" class="text-gray-700 hover:text-emerald-600 h-full flex items-center justify-center">CATEGORIES</Link>
        </li>
        <li v-if="$page.props.auth.user.role === 'admin'" class="h-full flex items-center justify-center">
          <Link :href="route('products.index')" class="text-gray-700 hover:text-emerald-600 h-full flex items-center justify-center">PRODUCTES</Link>
        </li>
        </template>
      </ul>
    </div>

    <!-- Usuari o login -->
    <div class="w-1/5 h-full flex items-center justify-center gap-6">
        <a href="/cart" class="text-gray-700 hover:text-emerald-600 flex items-center gap-2">
            <ShoppingCart class="h-6 w-6" />
        </a>
      <template v-if="$page.props.auth.user">
        <span class="text-gray-700">Hola, {{ $page.props.auth.user.name }}</span>
      </template>
      <template v-else>
        <a href="/login" class="text-emerald-600 border border-emerald-600 px-4 py-2 rounded hover:bg-emerald-600 hover:text-white transition">
          Iniciar sesión
        </a>
      </template>
    </div>
  </nav>
</template>
