<script setup>
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';

const pathParts = window.location.pathname.split('/');
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es';
</script>

<template>
  <Head :title="currentLang === 'ca' ? 'Política de galetes' : currentLang === 'en' ? 'Cookies Policy' : 'Política de Cookies'" />
  <Navbar />
  <div class="max-w-5xl mx-auto p-6 text-gray-800 mt-20">
    <h1 class="text-3xl font-bold mb-4">
      {{ currentLang === 'ca' ? 'Política de galetes' : currentLang === 'en' ? 'Cookies Policy' : 'Política de Cookies' }}
    </h1>

    <!-- INTRO -->
    <p v-if="currentLang === 'ca'" class="mb-4">
      A nidees.com utilitzem galetes amb l’objectiu de millorar l’experiència de navegació, analitzar l’ús del lloc web i oferir-te contingut personalitzat. A continuació t’expliquem què són les galetes, quins tipus utilitzem i com les pots gestionar.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      At nidees.com, we use cookies to improve your browsing experience, analyze website usage, and offer personalized content. Below, we explain what cookies are, the types we use, and how you can manage them.
    </p>
    <p v-else class="mb-4">
      En nidees.com utilizamos cookies con el objetivo de mejorar la experiencia de navegación, analizar el uso de la web y ofrecerte contenido personalizado. A continuación te explicamos qué son las cookies, qué tipos usamos y cómo puedes gestionarlas.
    </p>

    <!-- 1. ¿Qué son las cookies? -->
    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{
        currentLang === 'ca' ? '1. Què són les galetes?' :
        currentLang === 'en' ? '1. What are cookies?' :
        '1. ¿Qué son las cookies?'
      }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Les galetes són fitxers petits de text que es guarden al teu dispositiu (ordinador, mòbil, tauleta) quan visites una pàgina web. Serveixen per recordar les teves preferències, millorar el funcionament del lloc i recopilar informació estadística.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      Cookies are small text files stored on your device (computer, mobile, tablet) when you visit a website. They help remember your preferences, improve site functionality, and collect statistical information.
    </p>
    <p v-else class="mb-4">
      Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo (ordenador, móvil, tablet) cuando visitas una página web. Sirven para recordar tus preferencias, mejorar el funcionamiento del sitio y recopilar información estadística.
    </p>

    <!-- 2. Tipos de cookies -->
    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{
        currentLang === 'ca' ? '2. Tipus de galetes que utilitzem' :
        currentLang === 'en' ? '2. Types of cookies we use' :
        '2. Tipos de cookies que utilizamos'
      }}
    </h2>

    <ul v-if="currentLang === 'ca'" class="list-disc pl-6 mb-4">
      <li><strong>Galetes tècniques:</strong> necessàries per al funcionament de la web (com el carret de compra o l'inici de sessió).</li>
      <li><strong>Galetes d’anàlisi:</strong> ens permeten saber com naveguen els usuaris per la web (per exemple, mitjançant Google Analytics).</li>
      <li><strong>Galetes de personalització:</strong> recorden les teves preferències (idioma, regió, etc.).</li>
      <li><strong>Galetes publicitàries:</strong> s'utilitzen per mostrar anuncis personalitzats (per exemple, mitjançant Meta Pixel o Google Ads).</li>
    </ul>

    <ul v-else-if="currentLang === 'en'" class="list-disc pl-6 mb-4">
      <li><strong>Technical cookies:</strong> necessary for the website to function (such as the shopping cart or login).</li>
      <li><strong>Analytics cookies:</strong> help us understand how users browse the site (e.g., via Google Analytics).</li>
      <li><strong>Personalization cookies:</strong> remember your preferences (language, region, etc.).</li>
      <li><strong>Advertising cookies:</strong> used to show personalized ads (e.g., via Meta Pixel or Google Ads).</li>
    </ul>

    <ul v-else class="list-disc pl-6 mb-4">
      <li><strong>Cookies técnicas:</strong> necesarias para el funcionamiento de la web (como el carrito de compra o el inicio de sesión).</li>
      <li><strong>Cookies de análisis:</strong> nos permiten conocer cómo los usuarios navegan por la web (por ejemplo, a través de Google Analytics).</li>
      <li><strong>Cookies de personalización:</strong> recuerdan tus preferencias (idioma, región, etc.).</li>
      <li><strong>Cookies de publicidad:</strong> se utilizan para mostrar anuncios personalizados (por ejemplo, mediante Meta Pixel o Google Ads).</li>
    </ul>

    <!-- 3. Cookies propias y de terceros -->
    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{
        currentLang === 'ca' ? '3. Galetes pròpies i de tercers' :
        currentLang === 'en' ? '3. First- and third-party cookies' :
        '3. Cookies propias y de terceros'
      }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Les galetes poden ser:
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      Cookies can be:
    </p>
    <p v-else class="mb-4">
      Las cookies pueden ser:
    </p>

    <ul class="list-disc pl-6 mb-4">
      <li><strong>{{ currentLang === 'ca' ? 'Pròpies:' : currentLang === 'en' ? 'First-party:' : 'Propias:' }}</strong>
        {{
          currentLang === 'ca' ? ' gestionades directament per nidees.com.' :
          currentLang === 'en' ? ' managed directly by nidees.com.' :
          ' gestionadas directamente por nidees.com.'
        }}
      </li>
      <li><strong>{{ currentLang === 'ca' ? 'De tercers:' : currentLang === 'en' ? 'Third-party:' : 'De terceros:' }}</strong>
        {{
          currentLang === 'ca' ? ' gestionades per serveis externs com Google, Meta (Facebook/Instagram), Stripe, etc.' :
          currentLang === 'en' ? ' managed by external services such as Google, Meta (Facebook/Instagram), Stripe, etc.' :
          ' gestionadas por servicios externos como Google, Meta (Facebook/Instagram), Stripe, etc.'
        }}
      </li>
    </ul>

    <!-- 4. ¿Cómo puedes gestionar tus cookies? -->
    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{
        currentLang === 'ca' ? '4. Com pots gestionar les galetes?' :
        currentLang === 'en' ? '4. How can you manage your cookies?' :
        '4. ¿Cómo puedes gestionar tus cookies?'
      }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Quan accedeixes per primera vegada a la nostra web, et mostrem un bàner de consentiment on pots acceptar, rebutjar o configurar les galetes.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      When you first visit our website, we show you a consent banner where you can accept, reject or configure cookies.
    </p>
    <p v-else class="mb-4">
      Al acceder por primera vez a nuestra web, te mostramos un banner de consentimiento donde puedes aceptar, rechazar o configurar las cookies.
    </p>
    <p v-if="currentLang === 'ca'" class="mb-4">
      A més, pots modificar les teves preferències en qualsevol moment des del navegador:
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      You can also modify your preferences at any time through your browser:
    </p>
    <p v-else class="mb-4">
      Además, puedes modificar tus preferencias en cualquier momento desde tu navegador:
    </p>

    <ul class="list-disc pl-6 mb-4">
      <li><a href="https://support.google.com/chrome/answer/95647?hl=es" target="_blank" class="text-blue-600 underline">Google Chrome</a></li>
      <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" class="text-blue-600 underline">Mozilla Firefox</a></li>
      <li><a href="https://support.apple.com/es-es/HT201265" target="_blank" class="text-blue-600 underline">Safari</a></li>
      <li><a href="https://support.microsoft.com/es-es/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank" class="text-blue-600 underline">Internet Explorer / Edge</a></li>
    </ul>

    <!-- 5. Cambios en la política -->
    <h2 class="text-xl font-semibold mt-6 mb-2">
      {{
        currentLang === 'ca' ? '5. Canvis en la política de galetes' :
        currentLang === 'en' ? '5. Changes to the cookies policy' :
        '5. Cambios en la política de cookies'
      }}
    </h2>
    <p v-if="currentLang === 'ca'" class="mb-4">
      Aquesta política pot ser modificada per adaptar-se a nous requisits legals o tècnics. Et recomanem revisar-la periòdicament.
    </p>
    <p v-else-if="currentLang === 'en'" class="mb-4">
      This policy may be modified to comply with new legal or technical requirements. We recommend reviewing it periodically.
    </p>
    <p v-else class="mb-4">
      Esta política puede modificarse para adaptarse a nuevas exigencias legales o técnicas. Te recomendamos revisarla periódicamente.
    </p>

    <p class="mt-8 text-sm text-gray-500">
      {{ currentLang === 'ca' ? 'Última actualització: juliol 2025' : currentLang === 'en' ? 'Last update: July 2025' : 'Última actualización: julio 2025' }}
    </p>
  </div>
  <Footer />
</template>
