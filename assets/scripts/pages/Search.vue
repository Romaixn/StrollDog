<template>

    <Head title="Recherche" />

    <div class="relative pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">
            <div class="pb-16 px-4 sm:pb-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Lieux</h2>
                    <p class="mt-1 text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                        Trouvez votre balade</p>
                    <p class="max-w-xl mt-5 mx-auto text-xl text-gray-500">Tous les lieux ont étés ajoutés par les
                        membres.</p>
                </div>
            </div>
            <FormKit type="form" form-class="grid grid-cols-7 gap-6" :actions="false" @submit="submit">
                <div class="col-span-9 md:col-span-2">
                    <FormKit label="Recherche" type="search" v-model="form.search" />
                </div>
                <div class="col-span-9 md:col-span-2">
                    <FormKit label="Type de lieu" type="select" placeholder="Choisir un type" v-model="form.type"
                        :options="types" />
                </div>
                <div class="col-span-9 md:col-span-2">
                    <FormKit label="Affluence" type="select" placeholder="Choisir une catégorie" v-model="form.influx"
                        :options="influx" />
                </div>
                <div class="col-span-9 md:col-span-1 flex items-end">
                    <FormKit label="Rechercher" outerClass="w-full" type="submit" />
                </div>
            </FormKit>

            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none">
                <div v-for="place in places" :key="place.id" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img v-if="!isObjectEmpty(place.pictures)" class="h-48 w-full object-cover"
                            :src="'/uploads/images/places/' + place.pictures[0].image"
                            alt="Image de {{ place.title }}" />
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <inertia-link :href="route('place', place.id)" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">
                                    {{ place.title }}
                                </p>
                                <p v-html="place.description" class="mt-3 text-base text-gray-500 line-clamp-4"></p>
                            </inertia-link>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <a href="#">
                                    <span class="sr-only">AUTHOR NAME</span>
                                </a>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    <a href="#" class="hover:underline">
                                        AUTHOR NAME
                                    </a>
                                </p>
                                <div class="flex space-x-1 text-sm text-gray-500">
                                    <time :datetime="place.createdAt">
                                        {{ dateFormat(place.createdAt) }}
                                    </time>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '@/layouts/Front'
import { Head } from '@inertiajs/inertia-vue3'
import moment from 'moment'

export default {
    metaInfo: { title: 'Rechercher un lieu' },
    layout: Layout,
    components: {
        Head
    },
    props: {
        types: Array,
        influx: Array,
        places: Array,
    },
    data() {
        return {
            sending: false,
            form: {
                influx: null,
                type: null,
                search: null
            },
            errors: {},
        }
    },
    methods: {
        submit() {
            const data = new FormData()

            data.append('influx', this.form.influx || null)
            data.append('type', this.form.type || null)
            data.append('search', this.form.search || null)

            this.$inertia.post(this.route('search.submit'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
        isObjectEmpty(object) {
            return !(Object.keys(object).length)
        },
        dateFormat(date) {
            moment.locale('fr')
            return moment(date).format('LL')
        }
    }
}
</script>
