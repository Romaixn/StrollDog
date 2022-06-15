<template>
    <main>
        <h1 class="mb-8 font-bold text-3xl">Registration</h1>

        <form class="space-y-4" @submit.prevent="submit">
            <label for="username">Username</label>
            <input v-model="form.username" id="username" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="text" name="username" label="Username" />
            <label for="email">Email</label>
            <input v-model="form.email" id="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="email" type="email" label="Email" />
            <label for="name">Name</label>
            <input v-model="form.name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="name" type="text" label="Name" />
            <label for="password">Password</label>
            <input v-model="form.password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="password" type="password" autocomplete="new-password"
                label="Password" />
            <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="submit">Register</button>
        </form>
    </main>
</template>

<script>
import Layout from '@/layouts/Front'
import TextInput from '@/components/form/TextInput'

export default {
    metaInfo: { title: 'Registration' },
    layout: Layout,
    components: {
        TextInput
    },
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
