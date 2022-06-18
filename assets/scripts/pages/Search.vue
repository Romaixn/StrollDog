<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Rechercher un lieu</h1>
        <FormKit type="form" form-class="grid grid-cols-9 gap-6" :actions="false" @submit="submit">
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Recherche" type="text" v-model="form.search" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Note" type="number" min="1" max="5" v-model="form.rating" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Type de lieu" type="select" placeholder="Choisir un type" v-model="form.type" :options="types" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Affluence" type="select" placeholder="Choisir une catégorie" v-model="form.influx" :options="influx" />
            </div>
            <div class="col-span-7 sm:col-span-1 flex items-end">
                <FormKit label="Rechercher" type="submit" />
            </div>
        </FormKit>

        <div class="places-container">
            <div class="place" v-for="place in places">
                <div class="place-header">
                    <h2 class="place-title">{{ place.title }}</h2>
                    <p>{{ place.description }}</p>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'

export default {
    metaInfo: { title: 'Rechercher un lieu' },
    layout: Layout,
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
                rating: null,
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
            data.append('rating', this.form.rating || null)
            data.append('type', this.form.type || null)
            data.append('search', this.form.search || null)

            this.$inertia.post(this.route('search.submit'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
    }
}
</script>
