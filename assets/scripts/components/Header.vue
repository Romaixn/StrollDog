<template>
    <Popover
        class="sticky top-0 z-40 w-full backdrop-blur flex-none transition-colors duration-500 lg:z-50 bg-white/95 supports-backdrop-blur:bg-white/60 dark:bg-transparent">
        <header class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <inertia-link :href="route('home')">
                        <span class="sr-only">StrollDog</span>
                        <img class="h-8 w-auto sm:h-10" :src="logo" alt="StrollDog" />
                    </inertia-link>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <PopoverButton
                        class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Ouvrir le menu</span>
                        <MenuIcon class="h-6 w-6" aria-hidden="true" />
                    </PopoverButton>
                </div>
                <nav class="hidden md:flex space-x-10">
                    <inertia-link :href="route('home')" class="text-base font-medium text-gray-500 hover:text-gray-900">
                        Accueil </inertia-link>
                    <inertia-link :href="route('search')"
                        class="text-base font-medium text-gray-500 hover:text-gray-900"> Recherche </inertia-link>
                </nav>
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                    <inertia-link v-if="!isConnected" :href="route('login')"
                        class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Se connecter
                    </inertia-link>
                    <inertia-link v-if="!isConnected" :href="route('register')"
                        class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        S'inscrire </inertia-link>
                    <!-- Profile dropdown -->
                    <Menu v-if="isConnected" as="div" class="ml-3 relative">
                        <div>
                            <MenuButton
                                class="text-gray-500 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                <span class="sr-only">Ouvrir le menu utilisateur</span>
                                <img v-if="user.avatar" class="inline-block h-8 w-8 rounded-full object-cover"
                                    :src="'/uploads/images/users/' + user.avatar" alt="Avatar" aria-hidden="true" />
                                <UserCircleIcon v-if="!user.avatar" class="h-8 w-8 rounded-full" aria-hidden="true" />
                            </MenuButton>
                        </div>
                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-if="isAdmin" v-slot="{ active }">
                                <a :href="route('admin')"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Tableau
                                    de bord</a>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <inertia-link :href="route('account')"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Mon
                                    compte</inertia-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <inertia-link href="#"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                                    Paramètres</inertia-link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <inertia-link :href="route('logout')"
                                    :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Se
                                    déconnecter</inertia-link>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </header>

        <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in"
            leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
            <PopoverPanel focus class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
                v-slot="{ close }">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white">
                    <div class="pt-5 pb-2 px-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <img class="h-8 w-auto" :src="logo" alt="StrollDog" />
                            </div>
                            <div class="-mr-2">
                                <PopoverButton
                                    class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                    <span class="sr-only">Fermer le menu</span>
                                    <XIcon class="h-6 w-6" aria-hidden="true" />
                                </PopoverButton>
                            </div>
                        </div>
                    </div>
                    <div class="py-6 px-5 space-y-6">
                        <nav class="grid gap-y-8">
                            <inertia-link @click="close(close)" :href="route('home')"
                                class="block text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                Accueil </inertia-link>
                            <inertia-link @click="close(close)" :href="route('search')"
                                class="block text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                Recherche </inertia-link>
                        </nav>
                        <div>
                            <inertia-link v-if="!isConnected" @click="close(close)" :href="route('register')"
                                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                S'inscrire </inertia-link>
                            <p v-if="!isConnected" class="mt-6 text-center text-base font-medium text-gray-500">
                                Déjà utilisateur ?
                                {{ ' ' }}
                                <inertia-link @click="close(close)" :href="route('login')" class="text-indigo-600 hover:text-indigo-500"> Se
                                    connecter </inertia-link>
                            </p>
                            <div v-if="isConnected" class="pt-4 border-t border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <UserCircleIcon v-if="!user.avatar" class="h-10 w-10 rounded-full" aria-hidden="true" />
                                        <img v-if="user.avatar" class="h-10 w-10 rounded-full"
                                            :src="'/uploads/images/users/' + user.avatar" alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                                        <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                                    </div>
                                    <button type="button"
                                        class="ml-auto bg-white flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">View notifications</span>
                                        <BellIcon class="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>
                                <div class="mt-3 space-y-1">
                                    <a v-if="isAdmin" :href="route('admin')"
                                        class="block py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                        Tableau de bord </a>
                                    <inertia-link @click="close(close)" :href="route('account')"
                                        class="block py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                        Mon compte </inertia-link>
                                    <inertia-link @click="close(close)" :href="route('logout')"
                                        class="block py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                                        Se
                                        déconnecter </inertia-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </PopoverPanel>
        </transition>
    </Popover>
</template>

<script setup>
import { Popover, PopoverButton, PopoverPanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import {
    MenuIcon,
    XIcon,
    UserCircleIcon,
    BellIcon
} from '@heroicons/vue/outline'

const logo = require('@img/paw.svg');

const props = defineProps({
    user: Object,
    isConnected: {
        type: Boolean,
        required: true,
        default: false
    },
    isAdmin: {
        type: Boolean,
        required: true,
        default: false
    }
})

function close(close) {
    close();
}
</script>
