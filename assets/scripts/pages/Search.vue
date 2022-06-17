<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Search a place</h1>
        <form class="grid grid-cols-7 gap-6" @submit.prevent="submit">
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Rating" type="number" min="1" max="5" v-model="form.rating" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Type" type="select" v-model="form.type" :options="types" />
            </div>
            <div class="col-span-7 sm:col-span-2">
                <FormKit label="Influx" type="select" v-model="form.influx" :options="influx" />
            </div>
            <div class="col-span-7 sm:col-span-1 flex items-end">
                <FormKit label="Search" type="submit" />
            </div>
        </form>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'

export default {
    metaInfo: { title: 'Search' },
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

            this.$inertia.post(this.route('search_submit'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        }
    }
}
</script>
