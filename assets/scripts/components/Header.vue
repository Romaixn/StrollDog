<template>
  <Popover class="relative bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <inertia-link :href="route('home')">
            <span class="sr-only">StrollDog</span>
            <img class="h-8 w-auto sm:h-10" :src="logo" alt="StrollDog" />
          </inertia-link>
        </div>
        <div class="-mr-2 -my-2 md:hidden">
          <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Ouvrir le menu</span>
            <MenuIcon class="h-6 w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <nav class="hidden md:flex space-x-10">
          <inertia-link :href="route('home')" class="text-base font-medium text-gray-500 hover:text-gray-900"> Accueil </inertia-link>
          <inertia-link :href="route('search')" class="text-base font-medium text-gray-500 hover:text-gray-900"> Recherche </inertia-link>
        </nav>
        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <inertia-link v-if="!isConnected" :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"> Se connecter </inertia-link>
          <inertia-link v-if="!isConnected" :href="route('register')" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> S'inscrire </inertia-link>
          <!-- Profile dropdown -->
          <Menu v-if="isConnected" as="div" class="ml-3 relative">
            <div>
              <MenuButton class="text-gray-500 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span class="sr-only">Ouvrir le menu utilisateur</span>
                <UserCircleIcon class="h-8 w-8 rounded-full" aria-hidden="true" />
              </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <MenuItem v-if="isAdmin" v-slot="{ active }">
                  <a :href="route('admin')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Tableau de bord</a>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <inertia-link :href="route('account')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Mon compte</inertia-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <inertia-link href="#" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Paramètres</inertia-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <inertia-link :href="route('logout')" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Se déconnecter</inertia-link>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
      <PopoverPanel focus class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden" v-slot="{ close }">
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
          <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
              <div>
                <img class="h-8 w-auto" :src="logo" alt="StrollDog" />
              </div>
              <div class="-mr-2">
                <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Fermer le menu</span>
                  <XIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
          </div>
          <div class="py-6 px-5 space-y-6">
            <nav class="grid gap-y-8">
              <inertia-link @click="close(close)" :href="route('home')" class="-m-3 p-3 rounded-md hover:bg-gray-50 text-base font-medium text-gray-900 hover:text-gray-700"> Accueil </inertia-link>
              <inertia-link @click="close(close)" :href="route('search')" class="-m-3 p-3 rounded-md hover:bg-gray-50 text-base font-medium text-gray-900 hover:text-gray-700"> Recherche </inertia-link>
              <a v-if="isAdmin" @click="close(close)" :href="route('admin')" class="-m-3 p-3 rounded-md hover:bg-gray-50 text-base font-medium text-gray-900 hover:text-gray-700"> Tableau de bord </a>
            </nav>
            <div>
              <inertia-link v-if="!isConnected" :href="route('register')" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"> S'inscrire </inertia-link>
              <p v-if="!isConnected" class="mt-6 text-center text-base font-medium text-gray-500">
                Déjà utilisateur ?
                {{ ' ' }}
                <inertia-link :href="route('login')" class="text-indigo-600 hover:text-indigo-500"> Se connecter </inertia-link>
              </p>
              <inertia-link v-if="isConnected" :href="route('account')" class="text-indigo-600 hover:text-indigo-500"> Mon compte </inertia-link>
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
  UserCircleIcon
} from '@heroicons/vue/outline'

const logo = require('@img/paw.svg');

const props = defineProps({
    isConnected: {
        type: Boolean,
        required: true,
        default: false
    },
    isAdmin: {
        type: Boolean,
        required: true,
        default: false
    },
})

function close(close) {
    close();
}
</script>
