<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Rechercher un lieu</h1>
        <FormKit type="form" form-class="grid grid-cols-7 gap-6" :actions="false" @submit="submit">
            <div class="col-span-9 md:col-span-2">
                <FormKit label="Recherche" type="text" v-model="form.search" />
            </div>
            <div class="col-span-9 md:col-span-2">
                <FormKit label="Type de lieu" type="select" placeholder="Choisir un type" v-model="form.type" :options="types" />
            </div>
            <div class="col-span-9 md:col-span-2">
                <FormKit label="Affluence" type="select" placeholder="Choisir une catégorie" v-model="form.influx" :options="influx" />
            </div>
            <div class="col-span-9 md:col-span-1 flex items-end">
                <FormKit label="Rechercher" type="submit" />
            </div>
        </FormKit>

        <div class="grid grid-cols-1 divide-y">
            <div class="place p-2" v-for="place in places">
                <div class="place-header">
                    <h2 class="place-title">{{ place.title }}</h2>
                    <p v-html="place.description"></p>
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
    }
}
</script>
