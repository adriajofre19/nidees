<template>
  <div class="max-w-5xl mx-auto p-4 md:p-8 min-h-screen">
    <div class="bg-white rounded-lg p-4 md:p-8 ">
      <h1 class="text-2xl md:text-3xl font-normal text-gray-800 mb-8">Contacta amb nosaltres</h1>
      
      <form @submit.prevent="submitForm" class="space-y-6">
        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            Nom i cognoms *
          </label>
          <input
            v-model="form.name"
            type="text"
            id="name"
            required
            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300 bg-white text-gray-900"
          />
        </div>

        <!-- Email Field -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            Correu Electrònic *
          </label>
          <input
            v-model="form.email"
            type="email"
            id="email"
            required
            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300 bg-white text-gray-900"
          />
        </div>

        <!-- Subject Field -->
        <div>
          <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
            Assumpte
          </label>
          <input
            v-model="form.subject"
            type="text"
            id="subject"
            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300 bg-white text-gray-900"
          />
        </div>

        <!-- Message Field -->
        <div>
          <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
            Missatge
          </label>
          <textarea
            v-model="form.message"
            id="message"
            rows="6"
            class="w-full px-4 py-2 border border-gray-200 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-300 focus:border-gray-300 bg-white text-gray-900 resize-none"
          ></textarea>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          :disabled="isSubmitting"
          class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-medium py-3 px-6 rounded-md transition duration-200"
        >
          <span v-if="!isSubmitting">Enviar Missatge</span>
          <span v-else>Enviant...</span>
        </button>
      </form>

      <!-- Success Message -->
      <div v-if="showSuccess" class="mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-md">
        Missatge enviat correctament!
      </div>
    </div>

    <!-- Contact Information Section -->
    <div class="mt-12 pt-8 border-t border-gray-200">
      <h2 class="text-xl font-normal text-gray-600 mb-4">Contacte</h2>
      <div class="space-y-2 text-gray-600">
        <p>
          <span class="font-medium">Email:</span> 
          <a href="mailto:info@nidees.com" class="text-teal-600 hover:text-teal-700">
            info@nidees.com
          </a>
        </p>
        <p>
          <span class="font-medium">Tel:</span> 
          <a href="tel:+34972123456" class="text-teal-600 hover:text-teal-700">
            +34 972 123 456
          </a>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: ''
})

const isSubmitting = ref(false)
const showSuccess = ref(false)

const submitForm = async () => {
  isSubmitting.value = true
  showSuccess.value = false

  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500))
    
    // Reset form
    Object.keys(form).forEach(key => {
      form[key] = ''
    })
    
    showSuccess.value = true
    
    // Hide success message after 5 seconds
    setTimeout(() => {
      showSuccess.value = false
    }, 5000)
    
  } catch (error) {
    console.error('Error submitting form:', error)
  } finally {
    isSubmitting.value = false
  }
}
</script>

<style scoped>
/* Additional custom styles if needed */
input::placeholder,
textarea::placeholder {
  color: #9ca3af;
}
</style>