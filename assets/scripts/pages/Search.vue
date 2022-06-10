<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Search a place</h1>
        <form class="grid grid-cols-7 gap-6" @submit.prevent="submit">
            <div class="col-span-7 sm:col-span-2">
                <text-input v-model="form.rating" :error="errors.rating" type="number" label="Rating"/>
            </div>
            <div class="col-span-7 sm:col-span-2">
                <select-input v-model="form.type" :error="errors.type" label="Type">
                    <option v-for="elem in types" :value="elem.id" :key="elem.id">{{ elem.value }}</option>
                </select-input>
            </div>
            <div class="col-span-7 sm:col-span-2">
                <select-input v-model="form.influx" :error="errors.influx" label="Influx">
                    <option v-for="elem in influx" :value="elem.value" :key="elem.id">{{ elem.value }}</option>
                </select-input>
            </div>
            <div class="col-span-7 sm:col-span-1 flex items-end">
                <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Search</button>
            </div>
        </form>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'
import TextInput from '@/components/form/TextInput'
import SelectInput from '@/components/form/SelectInput'

export default {
    metaInfo: { title: 'Search' },
    layout: Layout,
    components: {
        TextInput,
        SelectInput
    },
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
            const data = {
                influx: this.form.influx,
                rating: this.form.rating,
                type: this.form.type,
            }

            console.log(data);

            this.$inertia.post(this.route('search_submit'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        }
    }
}
</script>
