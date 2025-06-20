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
</script>

<template>
    <Head title="Iniciar sesión" />
    <!-- component -->
    <div class="bg-white">
        <div class="flex justify-center h-screen">
            <!-- Imagen de fondo izquierda -->
            <div class="hidden lg:block lg:w-2/5 relative">
                <img
                    src="/images/playa.jpg"
                    alt="Imatge"
                    class="absolute inset-0 w-full h-full object-cover"
                />
                <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40 relative z-10">
                    <div>
                        <h2 class="text-4xl font-bold text-white">Brand</h2>
                        <p class="max-w-xl mt-3 text-gray-300">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus molestiae
                        </p>
                    </div>
                </div>
            </div>

            <!-- Formulari de login -->
            <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-3/5">
                <div class="flex-1">
                    <div class="text-center">
                        <img src="/images/logo2.png" alt="Logo" class="h-10 mx-auto mb-4">
                        <p class="mt-3 text-gray-500">Inicia sessió amb el teu compte</p>
                    </div>

                    <div class="mt-8">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="email" class="block mb-2 text-sm text-gray-600">Correu electrònic</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    name="email"
                                    id="email"
                                    placeholder="exemple@exemple.com"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                />
                            </div>

                            <div class="mt-6">
                                <div class="flex justify-between mb-2">
                                    <label for="password" class="text-sm text-gray-600">Contrasenya</label>
                                </div>
                                <input
                                    type="password"
                                    v-model="form.password"
                                    name="password"
                                    id="password"
                                    placeholder="La teva contrasenya"
                                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-emerald-400 focus:ring-emerald-400 focus:outline-none focus:ring focus:ring-opacity-40"
                                />
                            </div>

                            <div class="mt-6">
                                <button
                                    class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-emerald-500 rounded-md hover:bg-emerald-400 focus:outline-none focus:bg-emerald-400 focus:ring focus:ring-emerald-300 focus:ring-opacity-50">
                                    Iniciar sessió
                                </button>
                            </div>
                        </form>

                        <p class="mt-6 text-sm text-center text-gray-400">
                            No tens compte?
                            <Link :href="route('register')" class="text-emerald-500 focus:outline-none focus:underline hover:underline">
                                Registra't ara
                            </Link>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
