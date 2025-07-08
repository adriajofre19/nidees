<script setup>
import { useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
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

// Obtener el mes actual en catalán
const currentMonth = computed(() => {
  const monthNames = {
    ca: ['Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Desembre'],
    es: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    en: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
  }
  const now = new Date()
  return monthNames[currentLang.value][now.getMonth()]
})


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

const currentLang = computed(() => {
  const path = window.location.pathname
  if (path.startsWith('/en')) return 'en'
  if (path.startsWith('/ca')) return 'ca'
  return 'es'
})

const translations = {
  ca: {
    monthTitle: 'Aquest mes de',
    subtitle: 'ens Trobaràs a les Fires',
    addFair: '+ Afegeix una fira',
    createTitle: 'Crear Nova Fira',
    nameLabel: 'Nom de la Fira',
    namePlaceholder: 'Nom de la fira',
    horarioLabel: 'Horari',
    horarioPlaceholder: 'de les 10 a les 20h, diumenges',
    locationLabel: 'Ubicació',
    locationPlaceholder: 'Carrer, número i població',
    imageLabel: 'Imatge',
    save: 'Guardar',
    saving: 'Guardant...',
    cancel: 'Cancel·lar',
    deleteConfirm: 'Estàs segur que vols eliminar aquesta fira?',
    noFairs: 'No hi ha fires programades',
    soon: 'Aviat tindrem noves dates disponibles!',
    delete: 'Eliminar',
    previewAlt: 'Vista prèvia'
  },
  es: {
    monthTitle: 'Este mes de',
    subtitle: 'nos encontrarás en las Ferias',
    addFair: '+ Añadir una feria',
    createTitle: 'Crear Nueva Feria',
    nameLabel: 'Nombre de la Feria',
    namePlaceholder: 'Nombre de la feria',
    horarioLabel: 'Horario',
    horarioPlaceholder: 'de 10 a 20h, domingos',
    locationLabel: 'Ubicación',
    locationPlaceholder: 'Calle, número y localidad',
    imageLabel: 'Imagen',
    save: 'Guardar',
    saving: 'Guardando...',
    cancel: 'Cancelar',
    deleteConfirm: '¿Estás seguro de que quieres eliminar esta feria?',
    noFairs: 'No hay ferias programadas',
    soon: '¡Pronto tendremos nuevas fechas disponibles!',
    delete: 'Eliminar',
    previewAlt: 'Vista previa'
  },
  en: {
    monthTitle: 'This month of',
    subtitle: 'you will find us at the Fairs',
    addFair: '+ Add a fair',
    createTitle: 'Create New Fair',
    nameLabel: 'Fair Name',
    namePlaceholder: 'Name of the fair',
    horarioLabel: 'Schedule',
    horarioPlaceholder: 'from 10 AM to 8 PM, Sundays',
    locationLabel: 'Location',
    locationPlaceholder: 'Street, number and city',
    imageLabel: 'Image',
    save: 'Save',
    saving: 'Saving...',
    cancel: 'Cancel',
    deleteConfirm: 'Are you sure you want to delete this fair?',
    noFairs: 'No fairs scheduled',
    soon: 'We will have new dates available soon!',
    delete: 'Delete',
    previewAlt: 'Preview'
  }
}

const t = (key) => translations[currentLang.value][key]



</script>

<template>
  <div class="bg-gray-50 py-20 mt-20">
    <div class="container mx-auto px-4 text-center">
      <!-- Título dinámico con el mes actual -->
      <div class="mb-12">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
          {{ t('monthTitle') }}
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-700">
            {{ currentMonth }}
          </span>
        </h2>
        <p class="text-xl text-gray-600 font-medium">
          {{ t('subtitle') }}
        </p>
      </div>

      <!-- Botón para abrir el modal -->
      <button 
        v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
        @click="showModal = true"
        class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-lg font-semibold px-6 py-3 rounded-full transform transition-all duration-200 shadow-lg mb-12"
      >
        + Afegeix una fira
      </button>

      <!-- Modal -->
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <transition name="fade">
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 relative text-left m-4">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Crear Nova Fira</h1>
            <form @submit.prevent="submit" class="space-y-6">
              <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom de la Fira</label>
                <input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                  placeholder="Nom de la fira"
                />
                <p v-if="errors.name" class="text-sm text-red-500 mt-1">{{ errors.name }}</p>
              </div>
              
              <div>
                <label for="horario" class="block text-sm font-semibold text-gray-700 mb-2">Horari</label>
                <input
                  id="horario"
                  v-model="form.horario"
                  type="text"
                  class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                  placeholder="de les 10 a les 20h, diumenges"
                />
                <p v-if="errors.horario" class="text-sm text-red-500 mt-1">{{ errors.horario }}</p>
              </div>
              
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Ubicació</label>
                <textarea
                  v-model="form.location"
                  rows="3"
                  class="w-full px-4 py-3 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors resize-none"
                  placeholder="Carrer, número i població"
                ></textarea>
                <p class="text-red-500 text-sm mt-1" v-if="errors.location">{{ errors.location }}</p>
              </div>
              
              <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Imatge</label>
                <input
                  id="image"
                  type="file"
                  @change="handleImage"
                  accept="image/*"
                  class="block w-full text-sm text-gray-700 file:mr-4 file:py-3 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold transition-colors"
                />
                <p v-if="errors.image" class="text-sm text-red-500 mt-1">{{ errors.image }}</p>
                <div v-if="previewImage" class="mt-4">
                  <img :src="previewImage" alt="Vista prèvia" class="w-32 h-24 object-cover rounded-lg shadow-md" />
                </div>
              </div>
              
              <div class="flex gap-3 pt-4">
                <button
                  type="submit"
                  class="flex-1 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 disabled:opacity-50 transition-all duration-200"
                  :disabled="processing"
                >
                  {{ processing ? 'Guardant...' : 'Guardar' }}
                </button>
                <button
                  type="button"
                  @click="showModal = false"
                  class="flex-1 bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition-colors"
                >
                  Cancel·lar
                </button>
              </div>
            </form>
          </div>
        </transition>
      </div>

      <!-- Galería de fires mejorada -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
        <div
          v-for="fira in fires"
          :key="fira.id"
          class="fire-card group rounded-2xl shadow-lg overflow-hidden"
        >
          <div
            class="relative w-full h-80 flex items-end overflow-hidden bg-cover bg-center"
            :style="fira.image ? `background-image: url('/public/${fira.image}')` : 'background-color: #111827;'"
          >
            <div class="fire-overlay absolute inset-0 bg-gray-900 bg-opacity-70 transition-all duration-300"></div>
            
            <div class="relative w-full px-6 py-6 flex flex-col items-start z-10 transform transition-transform duration-300">
              <h3 class="text-white text-2xl font-bold mb-3 drop-shadow-lg leading-tight">
                {{ fira.name }}
              </h3>
              
              <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1 mb-3">
                <span class="text-white text-sm font-medium">{{ fira.horario }}</span>
              </div>
              
              <a
                :href="googleMapsUrl(fira.location)"
                target="_blank"
                class="text-emerald-300 text-sm flex items-center gap-2 font-medium transition-colors duration-200 group/link"
              >
                <MapIcon class="w-5 h-5 group-hover/link:scale-110 transition-transform" />
                <span class="group-hover/link:underline">{{ fira.location }}</span>
              </a>
              
              <button
                v-if="$page.props.auth.user && $page.props.auth.user.role === 'admin'"
                @click="deleteFira(fira.id)"
                class="mt-4 px-4 py-2 bg-red-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-lg transition-all duration-200 transform "
              >
                Eliminar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Mensaje cuando no hay fires -->
      <div v-if="!fires || fires.length === 0" class="text-center py-16">
        <div class="text-gray-400 text-6xl mb-4">📅</div>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">{{ t('noFairs') }}</h3>
        <p class="text-gray-500">{{ t('soon') }}</p>
      </div>
    </div>
  </div>
</template>
