<script setup>
const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
import Navbar from '@/Components/Navbar.vue';
import Footer from '@/Components/Footer.vue';
</script>
<template>
    <Head :title="currentLang === 'ca' ? 'Política de Privacidad' : currentLang === 'en' ? 'Privacy Policy' : 'Política de Privacidad'" />
    <Navbar />
    <div class="max-w-5xl mx-auto p-6 text-gray-800 mt-20">
      <h1 class="text-3xl font-bold mb-4">{{ currentLang === 'ca' ? 'Política de Privacidad' : currentLang === 'en' ? 'Privacy Policy' : 'Política de Privacidad' }}</h1>
  
      <p v-if="currentLang === 'ca'" class="mb-4">
        En <strong>nidees.com</strong>, nos comprometemos a proteger la privacidad de nuestros usuarios. Esta {{ currentLang === 'ca' ? 'política' : currentLang === 'en' ? 'policy' : 'política' }} explica cómo recopilamos, utilizamos y protegemos tu información personal.
      </p>
      <p v-else-if="currentLang === 'en'" class="mb-4">
        At <strong>nidees.com</strong>, we commit to protecting the privacy of our users. This {{ currentLang === 'ca' ? 'política' : currentLang === 'en' ? 'policy' : 'política' }} explains how we collect, use, and protect your personal information.
      </p>
      <p v-else class="mb-4">
        En <strong>nidees.com</strong>, nos comprometemos a proteger la privacidad de nuestros usuarios. Esta {{ currentLang === 'ca' ? 'política' : currentLang === 'en' ? 'policy' : 'política' }} explica cómo recopilamos, utilizamos y protegemos tu información personal.
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '1. Responsable del tratamiento' : currentLang === 'en' ? '1. Responsible of the treatment' : '1. Responsable del tratamiento' }}
      </h2>
      <p class="mb-4">
        {{ currentLang === 'ca' ? 'El responsable de los datos personales es:' : currentLang === 'en' ? 'The responsible of the treatment is:' : 'El responsable de los datos personales es:' }}
        <br />
        <strong>Nidees</strong><br />
        {{ currentLang === 'ca' ? 'Dirección: [Tu dirección física]' : currentLang === 'en' ? 'Address: [Your physical address]' : 'Dirección: [Tu dirección física]' }}
        <br />
        {{ currentLang === 'ca' ? 'Email de contacto: [tu-email@nidees.com]' : currentLang === 'en' ? 'Contact email: [tu-email@nidees.com]' : 'Email de contacto: [tu-email@nidees.com]' }}
        <br />
        {{ currentLang === 'ca' ? 'CIF/NIF: [Tu CIF o NIF]' : currentLang === 'en' ? 'CIF/NIF: [Your CIF or NIF]' : 'CIF/NIF: [Tu CIF o NIF]' }}
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '2. Datos que recopilamos' : currentLang === 'en' ? '2. Data collected' : '2. Datos que recopilamos' }}
      </h2>
      <ul class="list-disc pl-6 mb-4">
        <li>{{ currentLang === 'ca' ? 'Nombre y apellidos' : currentLang === 'en' ? 'Name and surname' : 'Nombre y apellidos' }}</li>
        <li>{{ currentLang === 'ca' ? 'Dirección de envío y facturación' : currentLang === 'en' ? 'Shipping and billing address' : 'Dirección de envío y facturación' }}</li>
        <li>{{ currentLang === 'ca' ? 'Correo electrónico' : currentLang === 'en' ? 'Email' : 'Correo electrónico' }}</li>
        <li>{{ currentLang === 'ca' ? 'Teléfono (opcional)' : currentLang === 'en' ? 'Phone (optional)' : 'Teléfono (opcional)' }}</li>
        <li>{{ currentLang === 'ca' ? 'Datos de pago (a través de pasarelas seguras)' : currentLang === 'en' ? 'Payment data (through secure gateways)' : 'Datos de pago (a través de pasarelas seguras)' }}</li>
        <li>{{ currentLang === 'ca' ? 'Información de navegación (cookies, IP, etc.)' : currentLang === 'en' ? 'Navigation information (cookies, IP, etc.)' : 'Información de navegación (cookies, IP, etc.)' }}</li>
      </ul>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '3. Finalidad del tratamiento' : currentLang === 'en' ? '3. Purpose of the treatment' : '3. Finalidad del tratamiento' }}
      </h2>
      <p class="mb-4">
        {{ currentLang === 'ca' ? 'Utilizamos tus datos para:' : currentLang === 'en' ? 'We use your data for:' : 'Utilizamos tus datos para:' }}
      </p>
      <ul class="list-disc pl-6 mb-4">
        <li>{{ currentLang === 'ca' ? 'Procesar y enviar tus pedidos' : currentLang === 'en' ? 'Process and send your orders' : 'Procesar y enviar tus pedidos' }}</li>
        <li>{{ currentLang === 'ca' ? 'Responder a tus consultas' : currentLang === 'en' ? 'Answer your questions' : 'Responder a tus consultas' }}</li>
        <li>{{ currentLang === 'ca' ? 'Enviar comunicaciones relacionadas con tus compras' : currentLang === 'en' ? 'Send communications related to your purchases' : 'Enviar comunicaciones relacionadas con tus compras' }}</li>
        <li>{{ currentLang === 'ca' ? 'Mejorar la experiencia en nuestra web' : currentLang === 'en' ? 'Improve the experience on our website' : 'Mejorar la experiencia en nuestra web' }}</li>
        <li>{{ currentLang === 'ca' ? 'Enviar boletines informativos si das tu consentimiento' : currentLang === 'en' ? 'Send informative newsletters if you give your consent' : 'Enviar boletines informativos si das tu consentimiento' }}</li>
      </ul>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '4. Base legal para el tratamiento' : currentLang === 'en' ? '4. Legal basis for treatment' : '4. Base legal para el tratamiento' }}
      </h2>
      <p class="mb-4">
        {{ currentLang === 'ca' ? 'La base legal es tu consentimiento, el cumplimiento de un contrato (compra) y el interés legítimo para mejorar nuestros servicios.' : currentLang === 'en' ? 'The legal basis is your consent, the fulfillment of a contract (purchase) and the legitimate interest to improve our services.' : 'La base legal es tu consentimiento, el cumplimiento de un contrato (compra) y el interés legítimo para mejorar nuestros servicios.' }}
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '5. Cesión de datos' : currentLang === 'en' ? '5. Data transfer' : '5. Cesión de datos' }}
      </h2>
      <p class="mb-4">
        {{ currentLang === 'ca' ? 'No cedemos tus datos a terceros salvo obligación legal o necesidad para prestar el servicio (por ejemplo, empresas de transporte o pasarelas de pago como Stripe o PayPal).' : currentLang === 'en' ? 'We do not transfer your data to third parties except for legal obligation or need to provide the service (for example, shipping companies or payment gateways like Stripe or PayPal).' : 'No cedemos tus datos a terceros salvo obligación legal o necesidad para prestar el servicio (por ejemplo, empresas de transporte o pasarelas de pago como Stripe o PayPal).' }}
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '6. Derechos del usuario' : currentLang === 'en' ? '6. User rights' : '6. Derechos del usuario' }}
      </h2>
      <p v-if="currentLang === 'ca'" class="mb-4">
        Puedes acceder, rectificar o eliminar tus datos, así como ejercer otros derechos escribiéndonos a <strong>[tu-email@nidees.com]</strong>. También puedes presentar una reclamación ante la AEPD (www.aepd.es).
      </p>
      <p v-else-if="currentLang === 'en'" class="mb-4">
        You can access, rectify or delete your data, as well as exercise other rights by writing to <strong>[tu-email@nidees.com]</strong>. You can also file a complaint with the AEPD (www.aepd.es).
      </p>
      <p v-else class="mb-4">
        Puedes acceder, rectificar o eliminar tus datos, así como ejercer otros derechos escribiéndonos a <strong>[tu-email@nidees.com]</strong>. También puedes presentar una reclamación ante la AEPD (www.aepd.es).
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ currentLang === 'ca' ? '7. Seguridad de los datos' : currentLang === 'en' ? '7. Data security' : '7. Seguridad de los datos' }}
      </h2>
      <p class="mb-4">
        {{ currentLang === 'ca' ? 'Aplicamos medidas técnicas y organizativas para proteger tus datos personales.' : currentLang === 'en' ? 'We apply technical and organizational measures to protect your personal data.' : 'Aplicamos medidas técnicas y organizativas para proteger tus datos personales.' }}
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">8. Uso de cookies</h2>
      <p v-if="currentLang === 'ca'" class="mb-4">
        Utilizamos cookies para mejorar tu experiencia de navegación. Puedes leer más en nuestra <a href="/cookies" class="text-blue-600 underline">Política de Cookies</a>.
      </p>
      <p v-else-if="currentLang === 'en'" class="mb-4">
        We use cookies to improve your navigation experience. You can read more in our <a href="/cookies" class="text-blue-600 underline">Cookie Policy</a>.
      </p>
      <p v-else class="mb-4">
        Utilizamos cookies para mejorar tu experiencia de navegación. Puedes leer más en nuestra <a href="/cookies" class="text-blue-600 underline">Política de Cookies</a>.
      </p>
  
      <h2 class="text-xl font-semibold mt-6 mb-2">
        {{ 
            currentLang === 'ca' ? '9. Cambios en la política' : currentLang === 'en' ? '9. Changes to the policy' : '9. Cambios en la política' }}
        </h2>
      <p class="mb-4">
        {{ 
            currentLang === 'ca' ? 'Nos reservamos el derecho a modificar esta política. Te informaremos de cualquier cambio significativo.' : currentLang === 'en' ? 'We reserve the right to modify this policy. We will inform you of any significant changes.' : 'Nos reservamos el derecho a modificar esta política. Te informaremos de cualquier cambio significativo.' }}
      </p>
  
      <p class="mt-8 text-sm text-gray-500">
        {{ currentLang === 'ca' ? 'Última actualización: julio 2025' : currentLang === 'en' ? 'Last update: July 2025' : 'Última actualización: julio 2025' }}
      </p>
    </div>
    <Footer />
  </template>
  