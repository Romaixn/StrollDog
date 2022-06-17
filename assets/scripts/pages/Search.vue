<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Rechercher un lieu</h1>
        <FormKit type="form" form-class="grid grid-cols-7 gap-6" :actions="false" @submit="submit">
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Note" type="number" min="1" max="5" v-model="form.rating" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Type" type="select" v-model="form.type" :options="types" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Affluence" type="select" v-model="form.influx" :options="influx" />
            </div>
            <div class="col-span-7 sm:col-span-1 flex items-end">
                <FormKit label="Rechercher" type="submit" />
            </div>
        </FormKit>
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
    },
    data() {
        return {
            sending: false,
            form: {
                influx: null,
                rating: null,
                type: null,
            },
            errors: {},
        }
    },
    methods: {
        submit() {
            const data = new FormData();

            data.append('influx', this.form.influx)
            data.append('rating', this.form.rating)
            data.append('type', this.form.type)

            this.$inertia.post(this.route('search.submit'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        }
    }
}
</script>
