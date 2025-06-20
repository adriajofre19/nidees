<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'
import RichTextEditor from '@/Components/RichTextEditor.vue'

const props = defineProps({
  categories: Array,
})

function generateSlug(name) {
  return name
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '')
}

const form = useForm({
  name: '',
  slug: '',
  description: '',
  image: [], // ← ahora es array
  price: 0,
  category_id: null,
})

const errors = ref({})
const processing = ref(false)
const previewImage = ref([])

function handleImage(e) {
  const files = Array.from(e.target.files)
  form.image = files
  previewImage.value = files.map(file => URL.createObjectURL(file))
}

function submit() {
  form.slug = generateSlug(form.name)

  processing.value = true
  form.post(route('products.store'), {
    forceFormData: true,
    onError: (err) => {
      errors.value = err
      processing.value = false
    },
    onSuccess: () => {
      processing.value = false
    }
  })
}
</script>

<template>
  <div class="max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Crear Producto</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-5">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="w-full px-3 py-2 text-sm border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nombre del producto"
          />
          <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <RichTextEditor v-model="form.description" />
          <p v-if="errors.description" class="text-sm text-red-500 mt-1">{{ errors.description }}</p>
        </div>

        <div>
          <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
          <input
            id="price"
            v-model.number="form.price"
            type="number"
            step="0.01"
            class="w-full px-3 py-2 text-sm border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Precio del producto"
          />
          <p v-if="errors.price" class="text-sm text-red-500 mt-1">{{ errors.price }}</p>
        </div>

        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
          <select
            id="category_id"
            v-model="form.category_id"
            class="w-full px-3 py-2 text-sm border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="" disabled>Selecciona una categoría</option>
            <option v-for="category in props.categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
          <p v-if="errors.category_id" class="text-sm text-red-500 mt-1">{{ errors.category_id }}</p>
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imágenes</label>
          <input
            id="image"
            type="file"
            multiple
            @change="handleImage"
            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-100 file:text-sm file:font-semibold hover:file:bg-gray-200"
          />
          <p v-if="errors.image" class="text-sm text-red-500 mt-1">{{ errors.image }}</p>

          <div v-if="previewImage.length" class="mt-4 flex flex-wrap gap-4">
            <img
              v-for="(src, index) in previewImage"
              :key="index"
              :src="src"
              alt="Vista previa"
              class="w-32 h-32 object-cover rounded-md shadow"
            />
          </div>
        </div>

        <button
          type="submit"
          class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-900 focus:ring-2 focus:ring-offset-2 focus:ring-black disabled:opacity-50"
          :disabled="processing"
        >
          Guardar
        </button>
      </form>
    </div>
  </div>
</template>
