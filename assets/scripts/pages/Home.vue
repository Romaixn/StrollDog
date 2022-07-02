<template>

    <Head title="Accueil" />

    <div class="relative">
        <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100"></div>
        <div class="max-w-7xl mx-auto sm:px-6">
            <div class="relative shadow-xl sm:rounded-2xl sm:overflow-hidden">
                <div class="absolute inset-0">
                    <img class="h-full w-full object-cover" :src="hero" alt="People walking with dogs">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-800 to-indigo-700 mix-blend-multiply">
                    </div>
                </div>
                <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                    <h1 class="text-center text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                        <span class="block text-white">Trouver une balade n'a jamais été</span>
                        <span class="block text-indigo-200">aussi simple</span>
                    </h1>
                    <p class="mt-6 max-w-lg mx-auto text-center text-xl text-indigo-200 sm:max-w-3xl">Trouver un lieu
                        qui vous correspond à vous et votre chien, organiser une balade simplement.</p>
                    <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                        <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                            <inertia-link :href="route('search')"
                                class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 sm:px-8">
                                Voir les lieux</inertia-link>
                            <inertia-link :href="route('register')"
                                class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-500 bg-opacity-60 hover:bg-opacity-70 sm:px-8">
                                S'inscrire</inertia-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative pt-16 pb-32 overflow-hidden">
        <div aria-hidden="true" class="absolute inset-x-0 top-0 h-48 bg-gradient-to-b from-gray-100" />
        <div class="relative">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
                <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-16 lg:max-w-none lg:mx-0 lg:px-0">
                    <div>
                        <div>
                            <span
                                class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600">
                                <LocationMarkerIcon class="h-6 w-6 text-white" aria-hidden="true" />
                            </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Trouver un lieu</h2>
                            <p class="mt-4 text-lg text-gray-500">Semper curabitur ullamcorper posuere nunc sed. Ornare
                                iaculis bibendum malesuada faucibus lacinia porttitor. Pulvinar laoreet sagittis viverra
                                duis. In venenatis sem arcu pretium pharetra at. Lectus viverra dui tellus ornare
                                pharetra.</p>
                            <div class="mt-6">
                                <inertia-link :href="route('search')"
                                    class="inline-flex bg-gradient-to-r from-purple-600 to-indigo-600 bg-origin-border px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white hover:from-purple-700 hover:to-indigo-700">Rechercher</inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0">
                    <div class="pl-4 -mr-48 sm:pl-6 md:-mr-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
                        <img class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none"
                            src="https://tailwindui.com/img/component-images/inbox-app-screenshot-1.jpg"
                            alt="Inbox user interface" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-24">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:grid-flow-col-dense lg:gap-24">
                <div class="px-4 max-w-xl mx-auto sm:px-6 lg:py-32 lg:max-w-none lg:mx-0 lg:px-0 lg:col-start-2">
                    <div>
                        <div>
                            <span
                                class="h-12 w-12 rounded-md flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600">
                                <SparklesIcon class="h-6 w-6 text-white" aria-hidden="true" />
                            </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Organiser une balade</h2>
                            <p class="mt-4 text-lg text-gray-500">Semper curabitur ullamcorper posuere nunc sed. Ornare
                                iaculis bibendum malesuada faucibus lacinia porttitor. Pulvinar laoreet sagittis viverra
                                duis. In venenatis sem arcu pretium pharetra at. Lectus viverra dui tellus ornare
                                pharetra.</p>
                            <div class="mt-6">
                                <inertia-link href="#"
                                    class="inline-flex bg-gradient-to-r from-purple-600 to-indigo-600 bg-origin-border px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white hover:from-purple-700 hover:to-indigo-700">Commencer</inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0 lg:col-start-1">
                    <div class="pr-4 -ml-48 sm:pr-6 md:-ml-16 lg:px-0 lg:m-0 lg:relative lg:h-full">
                        <img class="w-full rounded-xl shadow-xl ring-1 ring-black ring-opacity-5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none"
                            src="https://tailwindui.com/img/component-images/inbox-app-screenshot-2.jpg"
                            alt="Customer profile user interface" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative bg-gray-900">
        <div class="h-80 absolute inset-x-0 bottom-0 xl:top-0 xl:h-full">
          <div class="h-full w-full xl:grid xl:grid-cols-2">
            <div class="h-full xl:relative xl:col-start-2">
              <img class="h-full w-full object-cover opacity-25 xl:absolute xl:inset-0" :src="stats" alt="Walking dogs" />
              <div aria-hidden="true" class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-gray-900 xl:inset-y-0 xl:left-0 xl:h-full xl:w-32 xl:bg-gradient-to-r" />
            </div>
          </div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8 xl:grid xl:grid-cols-2 xl:grid-flow-col-dense xl:gap-x-8">
          <div class="relative pt-12 pb-64 sm:pt-24 sm:pb-64 xl:col-start-1 xl:pb-24">
            <h2 class="text-sm font-semibold tracking-wide uppercase">
              <span class="bg-gradient-to-r from-purple-300 to-indigo-300 bg-clip-text text-transparent">Statistiques</span>
            </h2>
            <p class="mt-3 text-3xl font-extrabold text-white">Disponible sur la plateforme</p>
            <p class="mt-5 text-lg text-gray-300">De nombreux lieux sont déjà disponibles sur StrollDog, n'attendez plus pour ajouter les vôtres !</p>
            <div class="mt-12 grid grid-cols-1 gap-y-12 gap-x-6 sm:grid-cols-2">
              <p v-for="item in metrics" :key="item.id">
                <span class="block text-2xl font-bold text-white">{{ item.stat }}</span>
                <span class="mt-1 block text-base text-gray-300"
                  ><span class="font-medium text-white">{{ item.emphasis }}</span> {{ item.rest }}</span
                >
              </p>
            </div>
          </div>
        </div>
      </div>

    <div class="bg-white">
        <div
            class="max-w-4xl mx-auto py-16 px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:flex lg:items-center lg:justify-between">
            <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                <span class="block">Prêt à commencer ?</span>
                <span
                    class="-mb-1 pb-1 block bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">Créer un compte</span>
            </h2>
            <div class="mt-6 space-y-4 sm:space-y-0 sm:flex sm:space-x-5">
                <a href="#"
                    class="flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 bg-origin-border px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white hover:from-purple-700 hover:to-indigo-700">En savoir plus</a>
                <inertia-link :href="route('register')"
                    class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-800 bg-indigo-50 hover:bg-indigo-100">Commencer</inertia-link>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '@/layouts/Front'
import { Head } from '@inertiajs/inertia-vue3'
import { LocationMarkerIcon, SparklesIcon, } from '@heroicons/vue/outline'

export default {
    layout: Layout,
    components: {
        Head,
        LocationMarkerIcon,
        SparklesIcon,
    },
    setup(props) {
        const hero = require('@img/dog-walk.jpg');

        const stats = require('@img/dog-walk-2.jpg');

        const metrics = [
            { id: 1, stat: props.placeCount + '+', emphasis: 'Lieux', rest: 'disponible.' },
            { id: 2, stat: props.userCount + '+', emphasis: 'Utilisateurs', rest: 'actifs.' },
            { id: 3, stat: props.cityCount + '+', emphasis: 'Villes', rest: 'différentes.' },
        ]

        return { hero, stats, metrics }
    },
    props: {
        placeCount: {
            type: Number,
            default: 0,
        },
        cityCount: {
            type: Number,
            default: 0,
        },
        userCount: {
            type: Number,
            default: 0,
        },
    }
}
</script>
