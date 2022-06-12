<template>
    <div>
        <Header :isConnected="auth.user !== null" :isAdmin="auth.user?.role.includes('ROLE_ADMIN')" />
        <main class="container mx-auto px-4 mt-4">
            <slot />
        </main>
    </div>
</template>

<script setup>
import Header from '@/components/Header'

const props = defineProps({
    auth: Object,
})
</script>
