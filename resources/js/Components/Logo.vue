<template>
  <svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision">
  <rect width="200" height="200" fill="#1a1a1a" rx="16" />
  
  <!-- Letra tipo "n" invertida -->
  <path d="M60,160 V90 
           A40,40 0 0,1 140,90 
           V160" 
        stroke="white" 
        stroke-width="14" 
        fill="none" 
        stroke-linecap="round"
        shape-rendering="geometricPrecision"/>

  <!-- Círculo superior (pequeño) -->
  <circle cx="160" cy="40" r="9" fill="white" shape-rendering="geometricPrecision"/>

  <!-- Círculo inferior (más cerca de la "n") -->
  <circle cx="160" cy="65" r="9" fill="white" shape-rendering="geometricPrecision"/>
</svg>


</template>
