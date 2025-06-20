<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

function generateSlug(name) {
  return name
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, '-') // Reemplaza caracteres no alfanuméricos por guiones
    .replace(/^-|-$/g, '') // Elimina guiones al principio y al final
}

const form = useForm({
  name: '',
  slug: generateSlug(name),
  description: '',
  image: null,
})

const errors = ref({})
const processing = ref(false)
const previewImage = ref(form.image ? `/storage/${form.image}` : null)

function handleImage(e) {
  const file = e.target.files[0]
  form.image = file
  if (file) {
    previewImage.value = URL.createObjectURL(file)
  }
}

function submit() {
  processing.value = true
  form.post(route('categories.store'), {
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
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Crear Categoría</h1>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 space-y-6">
      <form @submit.prevent="submit" class="space-y-5">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
          <input
            id="name"
            v-model="form.name"
            type="text"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Nombre de la categoría"
          />
          <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
        </div>

        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <textarea
            id="description"
            v-model="form.description"
            rows="4"
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Describe la categoría..."
          ></textarea>
          <p v-if="errors.description" class="text-sm text-red-500 mt-1">{{ errors.description }}</p>
        </div>

        <div>
          <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
          <input
            id="image"
            type="file"
            @change="handleImage"
            class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-gray-100 file:text-sm file:font-semibold hover:file:bg-gray-200"
          />
          <p v-if="errors.image" class="text-sm text-red-500 mt-1">{{ errors.image }}</p>
          <div v-if="previewImage" class="mt-4">
            <img :src="previewImage" alt="Vista previa" class="w-32 h-auto rounded-md shadow" />
          </div>
        </div>

        <button
          type="submit"
          class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black disabled:opacity-50"
          :disabled="processing"
        >
          Guardar
        </button>
      </form>
    </div>
  </div>
</template>
