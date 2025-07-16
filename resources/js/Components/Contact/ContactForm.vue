<template>
  <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
      <div class="absolute top-20 left-10 w-32 h-32 bg-emerald-100 rounded-full opacity-30 blur-xl"></div>
      <div class="absolute bottom-32 right-16 w-48 h-48 bg-teal-100 rounded-full opacity-20 blur-2xl"></div>
      <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-green-100 rounded-full opacity-25 blur-lg"></div>
    </div>

    <div class="relative max-w-7xl mx-auto p-6 md:p-12">
      <!-- Header Section -->
      <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl mb-6 shadow-lg">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
        </div>
        <h1 class="text-3xl md:text-4xl font-light text-gray-800 mb-4 tracking-tight">
          {{ currentLang === 'ca' ? 'Contacta amb nosaltres' : currentLang === 'en' ? 'Contact us' : 'Contáctanos' }}
        </h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto leading-relaxed">
          {{ currentLang === 'ca' ? 'Estem aquí per ajudar-te. Envia\'ns un missatge i et respondrem el més aviat possible.' : 
             currentLang === 'en' ? 'We\'re here to help you. Send us a message and we\'ll get back to you as soon as possible.' : 
             'Estamos aquí para ayudarte. Envíanos un mensaje y te responderemos lo antes posible.' }}
        </p>
      </div>

      <div class="grid lg:grid-cols-3 gap-12">
        <!-- Contact Form -->
        <div class="lg:col-span-2">
          <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 md:p-10 shadow-xl border border-white/20">
            <form @submit.prevent="submit" class="space-y-8">
              <!-- Name Field -->
              <div class="group">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-3 transition-colors group-focus-within:text-emerald-600">
                  <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    {{ currentLang === 'ca' ? 'Nom i cognoms' : currentLang === 'en' ? 'Name and surname' : 'Nombre y apellido' }} *
                  </span>
                </label>
                <input
                  v-model="form.name"
                  type="text"
                  id="name"
                  required
                  class="w-full px-5 py-4 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white/50 text-gray-900 transition-all duration-200 placeholder-gray-400"
                  :placeholder="currentLang === 'ca' ? 'Escriu el teu nom complet' : currentLang === 'en' ? 'Enter your full name' : 'Escribe tu nombre completo'"
                />
              </div>

              <!-- Email Field -->
              <div class="group">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-3 transition-colors group-focus-within:text-emerald-600">
                  <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    {{ currentLang === 'ca' ? 'Correu Electrònic' : currentLang === 'en' ? 'Email' : 'Correo electrónico' }} *
                  </span>
                </label>
                <input
                  v-model="form.email"
                  type="email"
                  id="email"
                  required
                  class="w-full px-5 py-4 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white/50 text-gray-900 transition-all duration-200 placeholder-gray-400"
                  :placeholder="currentLang === 'ca' ? 'nom@exemple.com' : currentLang === 'en' ? 'name@example.com' : 'nombre@ejemplo.com'"
                />
              </div>

              <!-- Subject Field -->
              <div class="group">
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-3 transition-colors group-focus-within:text-emerald-600">
                  <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    {{ currentLang === 'ca' ? 'Assumpte' : currentLang === 'en' ? 'Subject' : 'Asunto' }}
                  </span>
                </label>
                <input
                  v-model="form.subject"
                  type="text"
                  id="subject"
                  class="w-full px-5 py-4 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white/50 text-gray-900 transition-all duration-200 placeholder-gray-400"
                  :placeholder="currentLang === 'ca' ? 'De què vols parlar?' : currentLang === 'en' ? 'What do you want to talk about?' : '¿De qué quieres hablar?'"
                />
              </div>

              <!-- Message Field -->
              <div class="group">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-3 transition-colors group-focus-within:text-emerald-600">
                  <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    {{ currentLang === 'ca' ? 'Missatge' : currentLang === 'en' ? 'Message' : 'Mensaje' }}
                  </span>
                </label>
                <textarea
                  v-model="form.message"
                  id="message"
                  rows="6"
                  class="w-full px-5 py-4 border-2 border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 bg-white/50 text-gray-900 resize-none transition-all duration-200 placeholder-gray-400"
                  :placeholder="currentLang === 'ca' ? 'Explica\'ns com et podem ajudar...' : currentLang === 'en' ? 'Tell us how we can help you...' : 'Cuéntanos cómo podemos ayudarte...'"
                ></textarea>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                :disabled="isSubmitting"
                class="group relative w-full bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 text-white font-medium py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-xl disabled:opacity-70 disabled:cursor-not-allowed disabled:transform-none overflow-hidden"
              >
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <span class="relative flex items-center justify-center gap-3">
                  <svg v-if="!isSubmitting" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <Send />
                  </svg>
                  <svg v-else class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span v-if="!isSubmitting">
                    {{ currentLang === 'ca' ? 'Enviar Missatge' : currentLang === 'en' ? 'Send Message' : 'Enviar Mensaje' }}
                  </span>
                  <span v-else>
                    {{ currentLang === 'ca' ? 'Enviant...' : currentLang === 'en' ? 'Sending...' : 'Enviando...' }}
                  </span>
                </span>
              </button>
            </form>

            <!-- Success Message -->
            <div v-if="showSuccess" class="mt-8 p-6 bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-200 text-emerald-800 rounded-2xl shadow-sm">
              <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                  <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium">
                    {{ currentLang === 'ca' ? 'Missatge enviat correctament!' : currentLang === 'en' ? 'Message sent successfully!' : 'Mensaje enviado correctamente!' }}
                  </h3>
                  <p class="text-sm text-emerald-700 mt-1">
                    {{ currentLang === 'ca' ? 'Et respondrem el més aviat possible.' : currentLang === 'en' ? 'We\'ll get back to you as soon as possible.' : 'Te responderemos lo antes posible.' }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Information Sidebar -->
        <div class="lg:col-span-1">
          <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-3xl p-8 text-white shadow-xl">
            <h2 class="text-2xl font-light mb-8">
              {{ currentLang === 'ca' ? 'Informació de contacte' : currentLang === 'en' ? 'Contact information' : 'Información de contacto' }}
            </h2>
            
            <div class="space-y-6">
              <!-- Email -->
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium mb-1">Email</h3>
                  <a href="mailto:info@nidees.com" class="text-emerald-100 hover:text-white transition-colors">
                    info@nidees.com
                  </a>
                </div>
              </div>

              <!-- Phone -->
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium mb-1">
                    {{ currentLang === 'ca' ? 'Telèfon' : currentLang === 'en' ? 'Phone' : 'Teléfono' }}
                  </h3>
                  <a href="tel:+34972123456" class="text-emerald-100 hover:text-white transition-colors">
                    +34 972 123 456
                  </a>
                </div>
              </div>

              <!-- Instagram -->
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                  <Instagram class="w-6 h-6" />
                </div>
                <div>
                  <h3 class="font-medium mb-1">
                    {{ currentLang === 'ca' ? 'Instagram' : currentLang === 'en' ? 'Instagram' : 'Instagram' }}
                  </h3>
                  <a href="https://instagram.com/nidees_artplastic" class="text-emerald-100 hover:text-white transition-colors">
                    @nidees_artplastic
                  </a>
                </div>
              </div>

              <!-- Response time -->
              <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div>
                  <h3 class="font-medium mb-1">
                    {{ currentLang === 'ca' ? 'Temps de resposta' : currentLang === 'en' ? 'Response time' : 'Tiempo de respuesta' }}
                  </h3>
                  <p class="text-emerald-100 text-sm">
                    {{ currentLang === 'ca' ? 'Menys de 24 hores' : currentLang === 'en' ? 'Less than 24 hours' : 'Menos de 24 horas' }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Decorative element -->
            <div class="mt-8 pt-8 border-t border-white/20">
              <p class="text-emerald-100 text-sm leading-relaxed">
                {{ currentLang === 'ca' ? 'Estem compromesos a oferir-te la millor atenció possible. El teu missatge és important per a nosaltres.' : 
                   currentLang === 'en' ? 'We are committed to providing you with the best possible service. Your message is important to us.' : 
                   'Estamos comprometidos a ofrecerte la mejor atención posible. Tu mensaje es importante para nosotros.' }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Send, Instagram } from 'lucide-vue-next'

const pathParts = window.location.pathname.split('/')
const currentLang = ref(['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es')

const form = useForm({
  name: '',
  email: '',
  subject: '',
  message: ''
})

const isSubmitting = ref(false)
const showSuccess = ref(false)

function submit() {
  isSubmitting.value = true
  form.post('/contact', {
    onSuccess: () => {
      showSuccess.value = true
      form.reset()
      // Auto-hide success message after 5 seconds
      setTimeout(() => {
        showSuccess.value = false
      }, 5000)
    },
    onFinish: () => {
      isSubmitting.value = false
    }
  })
}
</script>

<style scoped>
/* Custom focus styles */
input:focus,
textarea:focus {
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

/* Smooth transitions for all interactive elements */
* {
  transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
  transition-duration: 200ms;
}

/* Custom scrollbar for textarea */
textarea::-webkit-scrollbar {
  width: 6px;
}

textarea::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>
