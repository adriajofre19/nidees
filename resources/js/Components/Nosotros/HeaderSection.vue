<template>
  <section class="bg-gradient-to-br from-slate-50 to-white py-20 mt-16">
    <div class="container mx-auto px-4 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <!-- Image Section - Left -->
        <div class="order-2 lg:order-1">
          <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-tr from-emerald-600 to-emerald-700 rounded-2xl transform rotate-3"></div>
            <img 
              src="/images/tienda.png" 
              :alt="currentLang === 'ca' ? 'Parada de productes NiDEES' : currentLang === 'es' ? 'Puesto de productos NiDEES' : 'NiDEES product booth'" 
              class="relative rounded-2xl shadow-2xl w-full h-auto object-cover transform -rotate-1 hover:rotate-0 transition-transform duration-300"
            />
          </div>
        </div>

        <!-- Content Section - Right -->
        <div class="order-1 lg:order-2 space-y-6">
          <!-- CATALÀ -->
          <div v-if="currentLang === 'ca'" class="space-y-6">
            <div class="space-y-4">
              <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
                La Nostre 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-700">
                  Aventura
                </span>
              </h2>
              <p class="text-xl font-semibold text-gray-800 leading-relaxed">
                Una passió, una família, una idea que ha crescut amb sentit.
              </p>
            </div>

            <div class="space-y-5 text-gray-700 leading-relaxed">
              <p class="text-lg">
                Tot va començar amb la nostra passió per descobrir món. En cada viatge, 
                tornàvem amb les butxaques plenes de plàstics amb tipografies i caràcters 
                que ens cridaven l'atenció. Potser té a veure amb el fet que vaig estudiar 
                disseny gràfic.
              </p>
              
              <p class="text-lg">
                Els guardàvem pensant: <em class="text-emerald-600 font-medium">"Un dia en farem alguna cosa"</em>. 
                No volíem llençar-los. Sabíem que, d'alguna manera, tenien valor.
              </p>

              <p class="text-lg">
                Amb el temps, la vida ens va portar per camins nous. Amb l'arribada de la 
                nostra petita Fiera, vam decidir que deixava la feina per dedicar-li el temps 
                que es mereixia. Entre jocs, riures, descobertes i molta creativitat compartida, 
                vam continuar experimentant plegats.
              </p>

              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 rounded-xl border-l-4 border-emerald-400">
                <p class="text-lg italic">
                  Un dia vam obrir l'armari de les bosses… i gairebé ens enterren! 
                  Aquell va ser un punt d'inflexió. Vam començar a jugar, fondre, 
                  provar textures i donar forma a peces úniques.
                </p>
              </div>

              <p class="text-lg">
                Les primeres les fèiem servir nosaltres, familiars i amics: bosses, fundes, 
                estoigs... funcionals i plenes de color.
              </p>

              <p class="text-lg">
                Fins que un dia, el meu company va ensenyar una de les creacions a un senyor 
                que feia fires. <span class="font-semibold text-emerald-600">"Ho regales?"</span>, 
                li va preguntar. I allò va encendre la flama.
              </p>

              <div class="bg-gradient-to-r from-green-50 to-emerald-100 p-6 rounded-xl">
                <p class="text-lg font-medium text-gray-800">
                  I així va néixer l'aventura de 
                  <img 
                    src="/images/logo2.png" 
                    alt="nidees logo" 
                    class="inline-block h-4 w-auto mx-1 align-middle"
                  />: 
                  un projecte familiar, fet amb les mans, el cor i la convicció de crear un món més sostenible.
                </p>
              </div>
            </div>
          </div>

          <!-- CASTELLANO -->
<div v-else-if="currentLang === 'es'" class="space-y-6">
  <div class="space-y-4">
    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
      Nuestra 
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-700">
        Aventura
      </span>
    </h2>
    <p class="text-xl font-semibold text-gray-800 leading-relaxed">
      Una pasión, una familia, una idea que ha crecido con sentido.
    </p>
  </div>

  <div class="space-y-5 text-gray-700 leading-relaxed">
    <p class="text-lg">
      Todo empezó con nuestra pasión por descubrir mundo. En cada viaje, 
      volvíamos con los bolsillos llenos de plásticos con tipografías y caracteres 
      que nos llamaban la atención. Quizás tenga que ver con que estudié 
      diseño gráfico.
    </p>
    
    <p class="text-lg">
      Los guardábamos pensando: <em class="text-emerald-600 font-medium">"Algún día haremos algo con esto"</em>. 
      No queríamos tirarlos. Sabíamos que, de algún modo, tenían valor.
    </p>

    <p class="text-lg">
      Con el tiempo, la vida nos llevó por nuevos caminos. Con la llegada de nuestra 
      pequeña Fiera, decidimos que dejaba el trabajo para dedicarle el tiempo 
      que se merecía. Entre juegos, risas, descubrimientos y mucha creatividad compartida, 
      seguimos experimentando juntos.
    </p>

    <div class="bg-gradient-to-r from-green-50 to-emerald-100 p-6 rounded-xl border-l-4 border-emerald-400">
      <p class="text-lg italic">
        Un día abrimos el armario de las bolsas… ¡y casi nos entierran! 
        Ese fue un punto de inflexión. Empezamos a jugar, fundir, 
        probar texturas y dar forma a piezas únicas.
      </p>
    </div>

    <p class="text-lg">
      Las primeras las usábamos nosotros, familiares y amigos: bolsas, fundas, 
      estuches... funcionales y llenas de color.
    </p>

    <p class="text-lg">
      Hasta que un día, mi compañero enseñó una de las creaciones a un señor 
      que iba a ferias. <span class="font-semiemerald">"¿Lo regalas?"</span>, 
      le preguntó. Y aquello encendió la chispa.
    </p>

    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl">
      <p class="text-lg font-medium text-gray-800">
        Y así nació la aventura de 
        <img 
          src="/images/logo2.png" 
          alt="logo nidees" 
          class="inline-block h-4 w-auto mx-1 align-middle"
        />: 
        un proyecto familiar, hecho con las manos, el corazón y la convicción de crear un mundo más sostenible.
      </p>
    </div>
  </div>
</div>


          <!-- ENGLISH -->
<div v-else class="space-y-6">
  <div class="space-y-4">
    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
      Our 
      <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-700">
        Adventure
      </span>
    </h2>
    <p class="text-xl font-semibold text-gray-800 leading-relaxed">
      A passion, a family, an idea that has grown with meaning.
    </p>
  </div>

  <div class="space-y-5 text-gray-700 leading-relaxed">
    <p class="text-lg">
      It all started with our passion for exploring the world. On every trip, 
      we returned with pockets full of plastic with typography and characters 
      that caught our attention. Maybe it has something to do with the fact that 
      I studied graphic design.
    </p>
    
    <p class="text-lg">
      We kept them thinking: <em class="text-emerald-600 font-medium">"One day we'll do something with this"</em>. 
      We didn’t want to throw them away. Somehow, we knew they had value.
    </p>

    <p class="text-lg">
      Over time, life led us down new paths. When our little Fiera arrived, 
      we decided I would leave my job to dedicate the time she deserved. 
      Between games, laughter, discoveries, and lots of shared creativity, 
      we kept experimenting together.
    </p>

    <div class="bg-gradient-to-r from-green-50 to-emerald-100 p-6 rounded-xl border-l-4 border-emerald-400">
      <p class="text-lg italic">
        One day we opened the bag closet… and they almost buried us! 
        That was a turning point. We started playing, melting, 
        testing textures, and shaping unique pieces.
      </p>
    </div>

    <p class="text-lg">
      At first, we used them ourselves — family and friends too: bags, pouches, 
      cases... functional and full of color.
    </p>

    <p class="text-lg">
      Until one day, my partner showed one of our creations to a man 
      who went to fairs. <span class="font-semiemerald">"Are you giving it away?"</span>, 
      he asked. And that lit the spark.
    </p>

    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl">
      <p class="text-lg font-medium text-gray-800">
        And that’s how the adventure of 
        <img 
          src="/images/logo2.png" 
          alt="nidees logo" 
          class="inline-block h-4 w-auto mx-1 align-middle"
        /> began: 
        a family project, made with hands, heart, and a commitment to building a more sustainable world.
      </p>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const pathParts = window.location.pathname.split('/')
const currentLang = ['ca', 'en'].includes(pathParts[1]) ? pathParts[1] : 'es'
</script>
