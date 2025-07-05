<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold mb-6">Productes destacats</h2>
    <div>
      <template v-for="(row, rowIndex) in rows" :key="rowIndex">
        <div
          :class="[
            'flex flex-wrap gap-4 mb-4',
            row.length === 1 ? 'justify-center' : '',
            row.length === 2 ? 'justify-center' : '',
            row.length === 3 ? 'justify-between' : ''
          ]"
        >
          <Link :href="route('product.show', product.slug)"
            v-for="product in row"
            :key="product.id"
            class="relative group rounded-lg overflow-hidden shadow hover:shadow-lg transition flex-1 basis-full sm:basis-[48%] md:basis-[30%] max-w-full sm:max-w-[48%] md:max-w-[32%]"
          >
            <div class="w-full aspect-[4/3] flex items-center justify-center bg-gray-100">
              <img
                v-if="product.images[0]"
                :src="`/storage/${product.images[0].path}`"
                :alt="product.name"
                class="object-cover w-full h-full transition-opacity duration-300 group-hover:opacity-60"
              />
              <span v-else class="text-gray-400">Sense imatge</span>
              <div
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-70"
              >
                <span class="text-white text-xl font-bold text-center px-2">
                  {{ product.name }}
                </span>
              </div>
            </div>
          </Link>
        </div>
      </template>
    </div>
  </div>
</template>


<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  products: {
    type: Array,
    required: true
  }
})

// Patró: 3, 2, 3, 2, 1
const pattern = [3, 2, 3, 2, 1]

const rows = computed(() => {
  const result = []
  let i = 0
  let p = 0
  const products = props.products
  while (i < products.length) {
    const count = pattern[p % pattern.length]
    result.push(products.slice(i, i + count))
    i += count
    p++
  }
  return result
})
</script>

<style scoped>
</style>
