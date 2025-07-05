<script setup>
import { defineProps, ref, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import { Plus, Pencil, Trash2 } from 'lucide-vue-next'
import Navbar from '@/Components/Navbar.vue'

const props = defineProps({
  products: Array,
})

console.log(props.products)

const search = ref('')

const filteredproducts = computed(() =>
  props.products.filter(products =>
    products.name.toLowerCase().includes(search.value.toLowerCase())
  )
)

function deleteproducts(id) {
  if (confirm('Segur que vols eliminar aquesta categoria?')) {
    router.delete(route('products.destroy', id))
  }
}
</script>

<template class="bg-gray-50 min-h-screen">
  <Navbar />
  <div class="max-w-7xl mx-auto px-6 py-10  min-h-screen">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-semibold">Productes</h1>
      <div class="flex items-center gap-2">
        <input
          v-model="search"
          type="text"
          placeholder="Cercar productes..."
          class="border border-gray-300 text-sm rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
        />
        <Link
          :href="route('products.create')"
          class="inline-flex items-center gap-2 bg-black text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-gray-800 transition"
        >
          <Plus class="w-4 h-4" />
          Nou Producte
        </Link>
      </div>
    </div>

    <div v-if="!filteredproducts.length" class="text-center text-gray-500">
      <p>No hi ha productes que coincideixin amb la cerca</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="products in filteredproducts"
        :key="products.id"
        class="rounded-xl border border-gray-200 shadow-sm bg-white overflow-hidden"
      >
        <div class="h-56 overflow-hidden rounded-t-xl">
          <img
            v-if="products.images[0]"
            :src="`/storage/${products.images[0].path}`"
            alt="Imatge de la categoria"
            class="object-cover w-full h-full"
          />
          <div v-else class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 text-sm">
            Sense imatge
          </div>
        </div>
        <div class="p-4">
          <h2 class="font-semibold text-base">{{ products.name }}</h2>
          <div class="prose max-w-none" v-html="products.description"></div>


          <div class="flex justify-end gap-3">
            <Link
              :href="route('products.edit', products.slug)"
              class="inline-flex items-center gap-2 bg-black text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-gray-800 transition"
            >
              <Pencil class="w-4 h-4" />
              Editar
          </Link>
            <button
              @click="deleteproducts(products.slug)"
              class="inline-flex items-center gap-2 bg-red-500 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-red-600 transition"
            >
              <Trash2 class="w-4 h-4" />
              Eliminar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

