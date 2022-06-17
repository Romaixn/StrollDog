<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Registration</h1>

        <form class="space-y-4" @submit.prevent="submit">
            <FormKit label="Username" type="text" validation="required" v-model="form.username" :errors="errors.username"/>
            <FormKit label="Email" type="email" validation="required|email" v-model="form.email" :errors="errors.email" />
            <FormKit label="Name" type="text" v-model="form.name" :errors="errors.name" />
            <FormKit label="Password" type="password" validation="required" v-model="form.password" :errors="errors.password" />
            <FormKit label="Confirm Password" type="password" validation="required|confirm" />
            <FormKit label="Register" type="submit" ignore="false" />
        </form>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'

export default {
    metaInfo: { title: 'Registration' },
    layout: Layout,
    props: {
        errors: Object
    },
    data() {
        return {
            sending: false,
            form: {
                username: null,
                email: null,
                name: null,
                password: null,
            },
        }
    },
    methods: {
        submit() {
            const data = new FormData()
            data.append('username', this.form.username || '')
            data.append('name', this.form.name || '')
            data.append('email', this.form.email || '')
            data.append('password', this.form.password || '')

            this.$inertia.post(this.route('register.store'), data, {
                onStart: () => this.sending = true,
                onFinish: () => this.sending = false,
            })
        },
    },
}
</script>
