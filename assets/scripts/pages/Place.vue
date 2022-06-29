<template>
    <Head :title="place.title" />

    <main>
        <h1 class="mb-8 font-bold text-3xl">{{ place.title }}</h1>
        <p v-html="place.description"></p>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'
import { Head } from '@inertiajs/inertia-vue3'

export default {
    layout: Layout,
    components: {
        Head
    },
    props: {
        place: Object,
    },
}
</script>
