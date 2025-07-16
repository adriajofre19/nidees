<script setup>
import { Link } from '@inertiajs/vue3';
import { Instagram, Facebook, Twitter, Mail } from 'lucide-vue-next'

function Year() {
  return new Date().getFullYear();
}

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
</script>

<template>
  <footer class="bg-white border-t">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Columna 1: Logo y descripción -->
        <div>
          <img src="/images/logo2.png" alt="nidees Logo" class="h-5 mb-4">

          <p v-if="currentLang === 'ca'" class="text-sm text-gray-600">
            Disseny sostenible amb plàstics reciclats.
            <br>
            Peces úniques fetes a mà, combinant art i funcionalitat.
          </p>
          <p v-else-if="currentLang === 'en'" class="text-sm text-gray-600">
            Sustainable design with recycled plastics.
            <br>
            Unique handmade pieces blending art and functionality.
          </p>
          <p v-else class="text-sm text-gray-600">
            Diseño sostenible con plásticos reciclados.
            <br>
            Piezas únicas hechas a mano, combinando arte y funcionalidad.
          </p>
        </div>

        <!-- Columna 2: Enlaces -->
        <div>
          <h3 v-if="currentLang === 'ca'" class="text-lg font-semibold mb-4">Enllaços</h3>
          <h3 v-else-if="currentLang === 'en'" class="text-lg font-semibold mb-4">Links</h3>
          <h3 v-else class="text-lg font-semibold mb-4">Enlaces</h3>

          <ul class="space-y-2">
            <li>
              <Link
                :href="currentLang === 'ca' ? '/ca/tienda' : currentLang === 'en' ? '/en/tienda' : '/tienda'"
                class="text-sm text-gray-600 hover:text-emerald-600"
              >
                {{ currentLang === 'ca' ? 'Botiga' : currentLang === 'en' ? 'Shop' : 'Tienda' }}
              </Link>

            </li>
            <li>
              <Link
                :href="currentLang === 'ca' ? '/ca/nosotros' : currentLang === 'en' ? '/en/nosotros' : '/nosotros'"
                class="text-sm text-gray-600 hover:text-emerald-600"
              >
                {{ currentLang === 'ca' ? 'Nosaltres' : currentLang === 'en' ? 'Us' : 'Nosotros' }}
              </Link>
            </li>
            <li>
              <a href="/contacto" class="text-sm text-gray-600 hover:text-emerald-600">
                {{ currentLang === 'ca' ? 'Contacte' : currentLang === 'en' ? 'Contact' : 'Contacto' }}
              </a>
            </li>
          </ul>
        </div>

        <!-- Columna 3: Legal -->
        <div>
          <h3 v-if="currentLang === 'ca'" class="text-lg font-semibold mb-4">Legal</h3>
          <h3 v-else-if="currentLang === 'en'" class="text-lg font-semibold mb-4">Legal</h3>
          <h3 v-else class="text-lg font-semibold mb-4">Legal</h3>

          <ul class="space-y-2">
            <li>
              <a :href="currentLang === 'ca' ? '/ca/privacidad' : currentLang === 'en' ? '/en/privacidad' : '/privacidad'" class="text-sm text-gray-600 hover:text-emerald-600">
                {{ currentLang === 'ca' ? 'Política de Privacitat' : currentLang === 'en' ? 'Privacy Policy' : 'Política de Privacidad' }}
              </a>
            </li>
            <li>
              <a :href="currentLang === 'ca' ? '/ca/cookies' : currentLang === 'en' ? '/en/cookies' : '/cookies'" class="text-sm text-gray-600 hover:text-emerald-600">
                {{ currentLang === 'ca' ? 'Política de Cookies' : currentLang === 'en' ? 'Cookies Policy' : 'Política de Cookies' }}
              </a>
            </li>
            <li>
              <a :href="currentLang === 'ca' ? '/ca/legal' : currentLang === 'en' ? '/en/legal' : '/legal'" class="text-sm text-gray-600 hover:text-emerald-600">
                {{ currentLang === 'ca' ? 'Avís Legal' : currentLang === 'en' ? 'Legal Notice' : 'Aviso Legal' }}
              </a>
            </li>
            <li>
              <a href="/terminos" class="text-sm text-gray-600 hover:text-emerald-600">
                {{ currentLang === 'ca' ? 'Termes i Condicions' : currentLang === 'en' ? 'Terms & Conditions' : 'Términos y Condiciones' }}
              </a>
            </li>
          </ul>
        </div>

        <!-- Columna 4: Redes sociales -->
        <div>
          <h3 v-if="currentLang === 'ca'" class="text-lg font-semibold mb-4">Segueix-nos</h3>
          <h3 v-else-if="currentLang === 'en'" class="text-lg font-semibold mb-4">Follow Us</h3>
          <h3 v-else class="text-lg font-semibold mb-4">Síguenos</h3>

          <div class="flex space-x-4">
            <a href="https://instagram.com/nidees_artplastic" class="text-gray-600 hover:text-emerald-600" aria-label="Instagram">
              <Instagram class="h-5 w-5" />
            </a>
            <a href="#" class="text-gray-600 hover:text-emerald-600" aria-label="Mail">
              <Mail class="h-5 w-5" />
            </a>
            <a href="#" class="text-gray-600 hover:text-emerald-600" aria-label="Twitter">
              <Twitter class="h-5 w-5" />
            </a>
          </div>
        </div>
      </div>

      <!-- Pie -->
      <div class="mt-8 pt-8 border-t">
        <div class="text-sm text-gray-600 text-center flex items-center justify-center">
          <p>© {{ Year() }}</p>
          <img src="/images/logo2.png" alt="Logo 2" class="h-3 mb-1 px-2" />
          <p>
            {{
              currentLang === 'ca'
                ? 'Tots els drets reservats.'
                : currentLang === 'en'
                ? 'All rights reserved.'
                : 'Todos los derechos reservados.'
            }}
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>
