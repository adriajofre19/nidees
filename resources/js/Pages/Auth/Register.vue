<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>

<div class="bg-white">
        <div class="flex justify-center h-screen">
            <div class="hidden lg:block lg:w-2/5 relative">
                <img
                    src="/images/register.webp"
                    alt="Imatge"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                
            </div>
            
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-3/5">
                <div class="flex-1">
                    <div class="text-center">
                        <img src="/images/logo_nidees.png" alt="Logo" class="h-10 mx-auto mb-4">
                        
                        <p class="mt-3 text-gray-500">Inicia sessió amb el teu compte</p>
                    </div>

                    <div class="mt-8">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="name" class="block mb-2 text-sm text-gray-600 ">Nom d'usuari</label>
                                <input type="text" v-model="form.name" name="name" id="name" placeholder="El teu nom d'usuari" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <label for="email" class="block mb-2 text-sm text-gray-600 ">Correu electrònic</label>
                                <input type="email" v-model="form.email" name="email" id="email" placeholder="exemple@exemple.com" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600 ">Contrasenya</label>
                                </div>

                                <input type="password" v-model="form.password" name="password" id="password" placeholder="La teva contrasenya" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password_confirmation" class="text-sm text-gray-600 ">Confirma la contrasenya</label>
                                </div>

                                <input type="password" v-model="form.password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="Confirma la teva contrasenya" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                            </div>

                            <div class="mt-6">
                                <button
                                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-emerald-500 rounded-md hover:bg-emerald-400 focus:outline-none focus:bg-emerald-400 focus:ring focus:ring-emerald-300 focus:ring-opacity-50">
                                    Registra&#x27;t
                                </button>
                            </div>

                        </form>

                        <p class="mt-6 text-sm text-center text-gray-400">Ja tens compte? <Link :href="route('login')" class="text-emerald-500 focus:outline-none focus:underline hover:underline">Inicia sessió</Link>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
