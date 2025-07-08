<script setup>
  const pathParts = window.location.pathname.split('/')
  const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
</script>

<template>
  <div class="w-full bg-red-500 bg-cover h-auto bg-[url(/images/bags.png)] flex flex-col items-center justify-center">
      <h1>
        En cada compra estàs contribuint en un món més sotenible.
      </h1>
      <div class="flex flex-row">
        <span>
          OPA OPA
          <img src="/images/logo2.png" class="h-4 w-auto" />
        </span>
      </div>
  </div>
</template>