<script setup>
    import { Instagram, Facebook, Twitter } from 'lucide-vue-next'
    function Year() {
        const currentYear = new Date().getFullYear();
        return currentYear;
    }
</script>

<template>
    <footer class="bg-white border-t">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      
      <div>
        <img src="/images/logo2.png" alt="niDEES Logo" class="h-5 mb-4">
        <p class="text-sm text-gray-600">
          Disseny sostenible amb plàstics reciclats.
          <br>
          Peçes úniques fetes a mà, combinant art i funcionalitat.
        </p>

      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Enlaces</h3>
        <ul class="space-y-2">
          <li><a href="/tienda" class="text-sm text-gray-600 hover:text-emerald-600">Tienda</a></li>
          <li><a href="/sobre-nosotros" class="text-sm text-gray-600 hover:text-emerald-600">Sobre Nosotros</a></li>
          <li><a href="/contacto" class="text-sm text-gray-600 hover:text-emerald-600">Contacto</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Legal</h3>
        <ul class="space-y-2">
          <li><a href="/privacidad" class="text-sm text-gray-600 hover:text-emerald-600">Política de Privacidad</a></li>
          <li><a href="/terminos" class="text-sm text-gray-600 hover:text-emerald-600">Términos y Condiciones</a></li>
        </ul>
      </div>

      <div>
        <h3 class="text-lg font-semibold mb-4">Síguenos</h3>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-600 hover:text-emerald-600" aria-label="Instagram">
            <Instagram class="h-5 w-5" />
          </a>
          <a href="#" class="text-gray-600 hover:text-emerald-600" aria-label="Facebook">
            <Facebook class="h-5 w-5" />
          </a>
          <a href="#" class="text-gray-600 hover:text-emerald-600" aria-label="Twitter">
            <Twitter class="h-5 w-5" />
          </a>
        </div>
      </div>

    </div>

    <div class="mt-8 pt-8 border-t">
      <div class="text-sm text-gray-600 text-center flex items-center mb- justify-center">
        <p>© {{ Year() }} </p> <img src="/images/logo2.png" class="h-3 mb-1 px-2"> <p> Todos los derechos reservados. </p>
      </div>
    </div>
  </div>
</footer>
</template>