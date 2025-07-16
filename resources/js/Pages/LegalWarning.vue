<script setup>
import Navbar from '@/Components/Navbar.vue'
import Footer from '@/Components/Footer.vue'
import { Head } from '@inertiajs/vue3'

const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
</script>

<template>
  <Head :title="currentLang === 'ca' ? 'Avís legal' : currentLang === 'en' ? 'Legal Notice' : 'Aviso legal'" />
  <Navbar />
  <div class="max-w-5xl mx-auto p-6 text-gray-800 mt-20">
    <h1 class="text-3xl font-bold mb-6">
      {{ currentLang === 'ca' ? 'Avís legal' : currentLang === 'en' ? 'Legal Notice' : 'Aviso legal' }}
    </h1>

    <p v-if="currentLang === 'ca'" class="mb-4">
      Aquest lloc web, nidees.com, és propietat de [Nom o empresa titular], amb domicili a [adreça] i amb NIF [número].
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      This website, nidees.com, is owned by [Name or company owner], located at [address] and with tax ID [number].
    </p>
    <p v-else class="mb-4">
      Este sitio web, nidees.com, es propiedad de [Nombre o empresa titular], con domicilio en [dirección] y con NIF [número].
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '1. Condicions d’ús' : currentLang === 'en' ? '1. Terms of Use' : '1. Condiciones de uso' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      L’ús d’aquest lloc web implica l’acceptació de les condicions establertes en aquest avís legal. Si no estàs d’acord amb alguna de les condicions, et recomanem no utilitzar el lloc.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      Using this website implies acceptance of the terms set out in this legal notice. If you do not agree with any of the terms, we recommend not using the site.
    </p>
    <p v-else class="mb-4">
      El uso de este sitio web implica la aceptación de las condiciones establecidas en este aviso legal. Si no estás de acuerdo con alguna de ellas, te recomendamos no utilizar el sitio.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '2. Propietat intel·lectual' : currentLang === 'en' ? '2. Intellectual Property' : '2. Propiedad intelectual' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Tots els continguts del lloc web (textos, imatges, logotips, dissenys, codi font...) estan protegits per drets de propietat intel·lectual i industrial, i són titularitat de [Nom o empresa].
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      All content on the website (texts, images, logos, designs, source code...) is protected by intellectual and industrial property rights and is owned by [Name or company].
    </p>
    <p v-else class="mb-4">
      Todos los contenidos del sitio web (textos, imágenes, logotipos, diseños, código fuente...) están protegidos por derechos de propiedad intelectual e industrial, y son titularidad de [Nombre o empresa].
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '3. Responsabilitat' : currentLang === 'en' ? '3. Liability' : '3. Responsabilidad' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      No ens fem responsables dels danys o perjudicis que puguin derivar-se de l’ús del lloc web o de la informació que conté.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      We are not responsible for any damage or loss that may result from the use of the website or the information it contains.
    </p>
    <p v-else class="mb-4">
      No nos hacemos responsables de los daños o perjuicios que puedan derivarse del uso del sitio web o de la información que contiene.
    </p>

    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{ currentLang === 'ca' ? '4. Legislació aplicable' : currentLang === 'en' ? '4. Applicable Law' : '4. Legislación aplicable' }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Aquest avís legal es regeix per la legislació espanyola. Per a qualsevol conflicte que pugui sorgir, les parts se sotmetran als jutjats i tribunals de [ciutat].
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      This legal notice is governed by Spanish law. For any conflict that may arise, the parties shall submit to the courts of [city].
    </p>
    <p v-else class="mb-4">
      Este aviso legal se rige por la legislación española. Para cualquier conflicto que pueda surgir, las partes se someterán a los juzgados y tribunales de [ciudad].
    </p>

    <p class="mt-8 text-sm text-gray-500">
      {{ currentLang === 'ca' ? 'Darrera actualització: juliol 2025' : currentLang === 'en' ? 'Last updated: July 2025' : 'Última actualización: julio 2025' }}
    </p>
  </div>
  <Footer />
</template>
