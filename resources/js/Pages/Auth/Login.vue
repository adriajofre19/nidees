<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const supportedLangs = ['ca', 'en']

// Detecta el idioma actual (si está en el primer segmento)
const pathParts = window.location.pathname.split('/')
const currentLang = supportedLangs.includes(pathParts[1]) ? pathParts[1] : 'es'

const translations = {
  es: {
    title: 'Iniciar sesión',
    subtitle: 'Inicia sesión con tu cuenta',
    emailLabel: 'Correo electrónico',
    emailPlaceholder: 'ejemplo@ejemplo.com',
    passwordLabel: 'Contraseña',
    passwordPlaceholder: 'Tu contraseña',
    loginButton: 'Iniciar sesión',
    loginWithGoogle: 'Iniciar sesión con Google',
    noAccount: '¿No tienes cuenta?',
    registerNow: 'Regístrate ahora',
  },
  ca: {
    title: 'Iniciar sessió',
    subtitle: 'Inicia sessió amb el teu compte',
    emailLabel: 'Correu electrònic',
    emailPlaceholder: 'exemple@exemple.com',
    passwordLabel: 'Contrasenya',
    passwordPlaceholder: 'La teva contrasenya',
    loginButton: 'Iniciar sessió',
    loginWithGoogle: 'Inicia sessió amb Google',
    noAccount: 'No tens compte?',
    registerNow: "Registra't ara",
  },
  en: {
    title: 'Login',
    subtitle: 'Log in with your account',
    emailLabel: 'Email',
    emailPlaceholder: 'example@example.com',
    passwordLabel: 'Password',
    passwordPlaceholder: 'Your password',
    loginButton: 'Log in',
    loginWithGoogle: 'Log in with Google',
    noAccount: "Don't have an account?",
    registerNow: 'Register now',
  }
}

const t = translations[currentLang]


</script>

<template>
    <Head :title="t.title" />
    <!-- component -->
    <div class="bg-white">
        <div class="flex justify-center h-screen">
            <!-- Imagen de fondo izquierda -->
            <div class="hidden lg:block lg:w-2/5 relative">
                <img
                    src="/images/playa.webp"
                    alt="Imatge"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                
            </div>

            <!-- Formulari de login -->
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-3/5">
                <div class="flex-1">
                    <div class="text-center">
                        <img src="/images/logo2.webp" alt="Logo" class="h-10 mx-auto mb-4">
                        <p class="mt-3 text-gray-500">{{ t.subtitle }}</p>
                    </div>

                    <div class="mt-8">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm text-gray-600">{{ t.emailLabel }}</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    name="email"
                                    id="email"
                                    :placeholder="t.emailPlaceholder"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600">{{ t.passwordLabel }}</label>
                                </div>
                                <input
                                    type="password"
                                    v-model="form.password"
                                    name="password"
                                    id="password"
                                    :placeholder="t.passwordPlaceholder"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                />
                            </div>

                            <div class="mt-6">
                                <button
                                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-bold py-2 sm:py-2 px-4 sm:px-6 rounded-md hover:from-emerald-700 hover:to-emerald-800 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none text-sm sm:text-base">
                                    {{ t.loginButton }}
                                </button>
                            </div>
                        </form>

                        <a href="/login-google" type="button" class="mt-6 w-full block bg-white hover:bg-gray-100 focus:bg-gray-100 text-gray-900 font-semibold rounded-lg px-4 py-2 border border-gray-300">
                            <div class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="w-6 h-6" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                            <span class="ml-4">
                                {{ t.loginWithGoogle }}
                            </span>
                            </div>
                        </a>

                        <p class="mt-6 text-sm text-center text-gray-400">
                            {{ t.noAccount }}
                            <Link :href="route('register')" class="text-emerald-500 focus:outline-none focus:underline hover:underline">
                                {{ t.registerNow }}
                            </Link>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
