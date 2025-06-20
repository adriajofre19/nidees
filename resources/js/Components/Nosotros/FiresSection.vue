<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { defineProps } from 'vue'
import { MapIcon } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  fires: Array
});

const form = useForm({
  name: '',
  horario: '',
  location: '',
  image: null,
});

const errors = ref({});
const processing = ref(false);
const previewImage = ref(null);

const handleImage = (e) => {
  const file = e.target.files[0];
  form.image = file;
  previewImage.value = URL.createObjectURL(file);
};

const submit = () => {
  processing.value = true;
  form.post(route('fires.store'), {
    forceFormData: true,
    onError: (err) => {
      errors.value = err;
      processing.value = false;
    },
    onSuccess: () => {
      processing.value = false;
      showModal.value = false;
      form.reset();
      previewImage.value = null;
    }
  });
};

const showModal = ref(false);

function googleMapsUrl(location) {
  return `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(location)}`
}

function deleteFira(id) {
  if (confirm('Estàs segur que vols eliminar aquesta fira?')) {
    router.delete(route('fires.destroy', id))
  }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>

<template>
  <div class="bg-gray-50 mt-20 py-16">
    <div class="container mx-auto px-4 text-center">
      <h2 class="text-2xl mb-8">Ens Trobaràs a les Fires</h2>

      <!-- Botó per obrir el modal -->
      <button v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
        @click="showModal = true"
        class="inline-flex items-center gap-2 bg-black text-white text-md font-medium px-4 py-2 rounded-md hover:bg-gray-800 transition"
      >
        + Afegeix una fira
      </button>

      <!-- Modal -->
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
        <transition name="fade">
          <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative text-left">
            <h1 class="text-3xl font-semibold mb-6 text-gray-900">Crear Nova Fira</h1>
            <form @submit.prevent="submit" class="space-y-5">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="Nombre de la feria"
                />
                <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
              </div>
              <div>
                <label for="horario" class="block text-sm font-medium text-gray-700 mb-1">Horario</label>
                <input
                  id="horario"
                  v-model="form.horario"
                  type="text"
                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="de las 10 a las 20h, domingos"
                />
                <p v-if="errors.horario" class="text-sm text-red-500 mt-1">{{ errors.horario }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ubicació</label>
                <textarea
                  v-model="form.location"
                  class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  placeholder="Calle, número y población"
                ></textarea>
                <p class="text-red-500 text-sm mt-1" v-if="errors.location">{{ errors.location }}</p>
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
              <div>
                <button
                  type="submit"
                  class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-black rounded-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black disabled:opacity-50"
                  :disabled="processing"
                >
                  Guardar
                </button>
                <button
                  type="button"
                  @click="showModal = false"
                  class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 ml-2"
                >
                  Cancelar
                </button>
              </div>
            </form>
          </div>
        </transition>
      </div>

      <!-- Galeria de fires -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-8">
        <div
          v-for="fira in fires"
          :key="fira.id"
          class="rounded-lg shadow-md flex flex-col overflow-hidden"
        >
          <div
            class="relative w-full h-80 flex items-end"
            :style="fira.image ? `background-image: url('/storage/${fira.image}'); background-size: cover; background-position: center;` : 'background: #222;'"
          >
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="relative w-full px-4 py-6 flex flex-col items-start z-10">
              <h3 class="text-white text-xl font-bold mb-2 drop-shadow">{{ fira.name }}</h3>
              <span class="text-gray-200 text-sm mb-2">{{ fira.horario }}</span>
              <a
                :href="googleMapsUrl(fira.location)"
                target="_blank"
                class="text-emerald-400 hover:underline text-md flex items-center"
              >
                <MapIcon class="w-6 h-6 mr-1" />
                {{ fira.location }}
              </a>
              <button
                v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
                @click="deleteFira(fira.id)"
                class="mt-4 px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition"
              >
                Elimina
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>