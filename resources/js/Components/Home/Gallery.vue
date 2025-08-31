<template>
  <div class="max-w-6xl mx-auto py-10 px-4">
    <div class="gallery">
      <template v-for="(row, rowIndex) in rows" :key="rowIndex">
        <div
          :class="[ 
            'flex flex-wrap gap-4 mb-4',
            row.length === 1 ? 'justify-center' : '',
            row.length === 2 ? 'justify-center' : '',
            row.length === 3 ? 'justify-between' : ''
          ]"
        >
          <Link 
            :href="currentLang === 'ca' ? `/ca/category/${category.slug}` : currentLang === 'en' ? `/en/category/${category.slug}` : `/category/${category.slug}`"
            v-for="category in row"
            :key="category.id"
            class="relative group rounded-lg overflow-hidden shadow hover:shadow-lg transition flex-1 basis-full sm:basis-[48%] md:basis-[30%] max-w-full sm:max-w-[48%] md:max-w-[32%] product-item opacity-0 transform translate-y-5"
          >
            <div class="w-full aspect-[4/3] flex items-center justify-center bg-gray-100">
              <img
                v-if="category.image"
                :src="`/public/${category.image}`"
                :alt="category.name"
                class="object-cover w-full h-full transition-opacity duration-300 group-hover:opacity-60"
              />
              <span v-else class="text-gray-400">Sense imatge</span>
              <div
                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-70"
              >
                <span class="text-white text-xl font-bold text-center px-2">
                  {{ category.name }}
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
import { computed, ref, onMounted, nextTick } from 'vue'
import { Link } from '@inertiajs/vue3'
import { gsap } from 'gsap'

const props = defineProps({
  products: {
    type: Array,
    required: true
  },
  categories: {
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
  
  /*const products = props.products
  while (i < products.length) {
    const count = pattern[p % pattern.length]
    result.push(products.slice(i, i + count))
    i += count
    p++
  }
  return result
  */

  const categories = props.categories
  while (i < categories.length) {
    const count = pattern[p % pattern.length]
    result.push(categories.slice(i, i + count))
    i += count
    p++
  }
  return result
})

const supportedLangs = ['ca', 'en']
const pathParts = window.location.pathname.split('/')
const currentLang = ref(supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es')

// ANIMACIÓ
onMounted(async () => {
  await nextTick()

  gsap.to('.product-item', {
    opacity: 1,
    y: 0,
    duration: 0.8,
    ease: 'power3.out',
    stagger: {
      each: 0.1,
      from: 'start'
    }
  })
})
</script>