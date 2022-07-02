<template>
    <div>
        <Header :user="auth.user" :isConnected="auth.user !== null" :isAdmin="auth.user?.role.includes('ROLE_ADMIN')" />
        <main>
            <slot />
        </main>
        <Footer />
    </div>
</template>

<script>
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import { useToast } from 'vue-toastification'

export default {
    components: {
        Header,
        Footer
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
