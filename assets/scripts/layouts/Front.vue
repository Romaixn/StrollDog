<template>
    <div>
        <Header :isConnected="auth.user !== null" :isAdmin="auth.user?.role.includes('ROLE_ADMIN')" />
        <main class="container mx-auto px-4 mt-4">
            <slot />
        </main>
    </div>
</template>

<script>
import Header from '@/components/Header'
import { useToast } from 'vue-toastification'

export default {
    components: {
        Header
    },
    props: {
        auth: {
            type: Object,
            required: true
        },
        flash: Object
    },
    mounted() {
        const toast = useToast();

        if (this.flash.success) {
            setTimeout(() => {
                toast.success(this.flash.success)
            })
        }

        if (this.flash.error) {
            setTimeout(() => {
                toast.error(this.flash.error)
            })
        }
    },
    updated() {
        const toast = useToast();

        if (this.flash.success) {
            setTimeout(() => {
                toast.success(this.flash.success)
            })
        }

        if (this.flash.error) {
            setTimeout(() => {
                toast.error(this.flash.error)
            })
        }
    },
}
</script>
