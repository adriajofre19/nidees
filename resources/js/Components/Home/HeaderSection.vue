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

<div class="relative z-20 flex max-w-7xl mx-auto -mb-8 sm:-mb-20 px-4 mt-20 ">
  <div class="flex w-full justify-end">
    <img 
      src="/images/rotate.webp" 
      alt="Rotate icon"
      class="w-16 sm:w-20 md:w-24 lg:w-32 animate-slow-spin" 
    />
  </div>
</div>


  <div class="w-full aspect-[16/9] lg:aspect-auto lg:h-[839px] bg-[#e9e9e9] bg-[url(/images/header.webp)] bg-no-repeat bg-center lg:bg-left bg-cover xl:bg-contain flex items-center justify-around">
  <div class="w-full max-w-7xl px-6 md:px-12 flex flex-col items-end justify-around gap-6 h-full">
    <h1 
      ref="textRef" 
      class="relative z-10 text-4xl sm:text-5xl md:text-5xl lg:text-[90px] xl:text-[120px] font-bold leading-tight text-left text-black"
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
      class="relative z-10 h-8 sm:h-24 w-auto opacity-0 drop-shadow-lg"
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
