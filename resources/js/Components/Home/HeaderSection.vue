<script setup>
import { onMounted, ref, nextTick } from 'vue'
import { gsap } from 'gsap'

const textRef = ref(null)
const box = ref(null)

onMounted(async () => {
  await nextTick()

  const letters = textRef.value.querySelectorAll('span')

  const tl = gsap.timeline({ defaults: { ease: 'power3.out' } })

  tl.fromTo(
    letters,
    { opacity: 0, y: 50, rotateX: -90 },
    {
      opacity: 1,
      y: 0,
      rotateX: 0,
      stagger: 0.08,
      duration: 1,
      transformOrigin: 'center bottom'
    }
  )

  tl.fromTo(
    box.value,
    {
      opacity: 0,
      scale: 0.5,
      rotate: -15,
      x: -100
    },
    {
      opacity: 1,
      scale: 1,
      rotate: 0,
      x: 0,
      duration: 1.2,
      ease: 'back.out(1.7)'
    },
    '-=0.5' // empieza 0.5s antes que acabe la animación anterior
  )
})
</script>


<template>

<div class="relative z-20 flex max-w-7xl mx-auto -mb-20 px-4 mt-20">
  <div class="flex w-full md:justify-end justify-start">
    <img 
      src="/images/rotate.webp" 
      alt="Rotate icon"
      class="w-16 sm:w-20 md:w-28 lg:w-32 animate-slow-spin" 
    />
  </div>
</div>


  <div class="w-full md:h-[839px] h-[600px] bg-[#e9e9e9]">
    <div class="bg-[url(/images/header.webp)] bg-no-repeat relative overflow-hidden md:h-[839px] h-[600px] w-full flex flex-col md:items-end items-center lg:items-center md:gap-12 gap-6 justify-center">
  
  <!-- Capa blanca translúcida només visible en pantalles petites -->
  <div class="absolute inset-0 bg-white/30 xl:hidden z-0"></div>

  <h1 
    ref="textRef" 
    class="relative z-10 text-5xl sm:text-5xl md:text-6xl lg:text-7xl xl:text-[80px] font-bold text-center leading-tight text-black"
  >
    <span
      v-for="(letter, index) in 'UPCYCLING'.split('')"
      :key="index"
      class="inline-block"
    >
      {{ letter }}
    </span>
  </h1>

  <img 
    ref="box" 
    src="/images/bolsas.webp" 
    alt="Bolsas recicladas"
    class="relative z-10 h-20 sm:h-24 md:h-24 lg:h-28 xl:h-32 w-auto md:-ml-32 -ml-12 opacity-0 drop-shadow-lg"
  />

</div>
  </div>

</template>


<style>
@keyframes slow-spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

.animate-slow-spin {
  animation: slow-spin 3s linear infinite;
}
</style>
