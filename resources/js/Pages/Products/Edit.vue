<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'
import RichTextEditor from '@/Components/RichTextEditor.vue'
import Navbar from '@/Components/Navbar.vue'

const props = defineProps({
  product: Object,
  categories: Array,
})

function generateSlug(name) {
  return name
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-|-$/g, '')
}

const form = useForm({
  name: props.product.name || '',
  slug: props.product.slug || generateSlug(props.product.name),
  description: props.product.description || '',
  ca_description: props.product.ca_description || '', // nuevo campo
  en_description: props.product.en_description || '', // nuevo campo
  images: [], // nuevas imágenes seleccionadas
  current_images: props.product.images || [], // imágenes existentes
  removed_images: [], // IDs de imágenes eliminadas
  price: props.product.price || 0,
  category_id: props.product.category_id || null,
})

const errors = ref({})
const processing = ref(false)
const previewImage = ref([]) // <-- AFEGEIX AIXÒ

function handleImages(e) {
  form.images = Array.from(e.target.files)
  previewImage.value = form.images.map(file => URL.createObjectURL(file)) // <-- MODIFICA AIXÒ
}

function removeImage(imageId) {
  form.removed_images.push(imageId)
  form.current_images = form.current_images.filter(img => img.id !== imageId)
}

function submit() {
  processing.value = true
  form.post(route('products.update', props.product.slug), {
    forceFormData: true,
    preserveScroll: true,
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
  <Navbar />
  <div class="max-w-xl mx-auto mt-28">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Editar Producto</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-5">
        <!-- Nombre -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nombre del producto"
          />
          <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
        </div>

        <!-- Descripción -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <RichTextEditor v-model="form.description" />
          <p v-if="errors.description" class="text-sm text-red-500 mt-1">{{ errors.description }}</p>
        </div>

        <!-- Descripción en Catalán -->
        <div>
          <label for="ca_description" class="block text-sm font-medium text-gray-700 mb-1">Descripción en Catalán</label>
          <RichTextEditor v-model="form.ca_description" />
          <p v-if="errors.ca_description" class="text-sm text-red-500 mt-1">{{ errors.ca_description }}</p>
        </div>

        <!-- Descripción en Inglés -->
        <div>
          <label for="en_description" class="block text-sm font-medium text-gray-700 mb-1">Descripción en Inglés</label>
          <RichTextEditor v-model="form.en_description" />
          <p v-if="errors.en_description" class="text-sm text-red-500 mt-1">{{ errors.en_description }}</p>
        </div>

        <!-- Precio -->
        <div>
          <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
          <input
            id="price"
            v-model.number="form.price"
            type="number"
            step="0.01"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Precio del producto"
          />
          <p v-if="errors.price" class="text-sm text-red-500 mt-1">{{ errors.price }}</p>
        </div>

        <!-- Categoría -->
        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
          <select
            id="category_id"
            v-model="form.category_id"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
          >
            <option value="" disabled>Selecciona una categoría</option>
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.name }}
            </option>
          </select>
          <p v-if="errors.category_id" class="text-sm text-red-500 mt-1">{{ errors.category_id }}</p>
        </div>

        <!-- Imágenes actuales -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Imágenes actuales</label>
          <div class="flex gap-4 flex-wrap mb-4">
            <div
              v-for="image in form.current_images"
              :key="image.id"
              class="relative w-32 h-32 rounded overflow-hidden border"
            >
              <img :src="`/public/${image.path}`" class="object-cover w-full h-full" />
              <button
                type="button"
                @click="removeImage(image.id)"
                class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center hover:bg-red-700"
              >
                ✕
              </button>
            </div>
            <p v-if="!form.current_images.length" class="text-gray-400 text-sm">Sin imágenes</p>
          </div>

          <!-- Subir nuevas imágenes -->
          <label for="images" class="block text-sm font-medium text-gray-700 mb-1">Añadir nuevas imágenes</label>
          <input
            id="images"
            type="file"
            multiple
            @change="handleImages"
            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-100 file:text-sm file:font-semibold hover:file:bg-gray-200"
          />
          <p v-if="errors.images" class="text-sm text-red-500 mt-1">{{ errors.images }}</p>

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

        <!-- Botón -->
        <button
          type="submit"
          class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black disabled:opacity-50"
          :disabled="processing"
        >
          Guardar cambios
        </button>
      </form>
    </div>
  </div>
</template>
