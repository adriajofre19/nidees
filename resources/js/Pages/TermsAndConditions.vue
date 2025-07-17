<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
</script>

<template>
  <Head :title="currentLang === 'ca' ? 'Termes i condicions' : currentLang === 'en' ? 'Terms and Conditions' : 'Términos y condiciones'" />
  <Navbar />
  <div class="max-w-5xl mx-auto p-6 text-gray-800 mt-20">
    <h1 class="text-3xl font-bold mb-6">
      {{ currentLang === 'ca' ? 'Termes i condicions' : currentLang === 'en' ? 'Terms and Conditions' : 'Términos y condiciones' }}
    </h1>

    <p v-if="currentLang === 'ca'" class="mb-4">
      Aquests termes i condicions regulen l’accés i ús del lloc web nidees.com, així com la relació entre l’usuari i el titular del lloc.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      These terms and conditions govern access to and use of the website nidees.com, as well as the relationship between the user and the website owner.
    </p>
    <p v-else class="mb-4">
      Estos términos y condiciones regulan el acceso y uso del sitio web nidees.com, así como la relación entre el usuario y el titular del sitio.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '1. Acceptació dels termes' : currentLang === 'en' ? '1. Acceptance of Terms' : '1. Aceptación de los términos' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      L’ús del lloc implica l’acceptació plena i sense reserves dels presents termes i condicions. Si no hi estàs d’acord, no utilitzis aquest lloc web.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      By using the site, you fully and unconditionally accept these terms and conditions. If you do not agree, please do not use this website.
    </p>
    <p v-else class="mb-4">
      El uso del sitio implica la aceptación plena y sin reservas de estos términos y condiciones. Si no estás de acuerdo, no utilices este sitio web.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '2. Ús del lloc' : currentLang === 'en' ? '2. Use of the Site' : '2. Uso del sitio' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      L’usuari es compromet a utilitzar el lloc i els seus continguts de manera lícita i respectuosa, i a no dur a terme cap activitat que pugui danyar-lo o interferir en el seu funcionament.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      The user agrees to use the site and its content in a lawful and respectful manner, and not to engage in any activity that may harm or interfere with its operation.
    </p>
    <p v-else class="mb-4">
      El usuario se compromete a utilizar el sitio y sus contenidos de forma lícita y respetuosa, y a no realizar ninguna actividad que pueda dañarlo o interferir en su funcionamiento.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '3. Modificacions' : currentLang === 'en' ? '3. Modifications' : '3. Modificaciones' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Ens reservem el dret a modificar en qualsevol moment aquests termes i condicions. Les modificacions entraran en vigor des del moment de la seva publicació al lloc web.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      We reserve the right to modify these terms and conditions at any time. Changes will take effect as soon as they are published on the website.
    </p>
    <p v-else class="mb-4">
      Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Las modificaciones entrarán en vigor desde el momento de su publicación en el sitio web.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '4. Legislació aplicable' : currentLang === 'en' ? '4. Applicable Law' : '4. Legislación aplicable' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Aquests termes i condicions es regeixen per la legislació espanyola. Per a qualsevol disputa, les parts se sotmetran als jutjats i tribunals de Girona.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      These terms and conditions are governed by Spanish law. In case of any dispute, the parties will submit to the courts of Girona.
    </p>
    <p v-else class="mb-4">
      Estos términos y condiciones se rigen por la legislación española. Para cualquier disputa, las partes se someterán a los juzgados y tribunales de Girona.
    </p>

    <p class="mt-8 text-sm text-gray-500">
      {{ currentLang === 'ca' ? 'Darrera actualització: juliol 2025' : currentLang === 'en' ? 'Last updated: July 2025' : 'Última actualización: julio 2025' }}
    </p>
  </div>
  <Footer />
</template>
