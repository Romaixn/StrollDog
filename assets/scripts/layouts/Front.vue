<template>
    <div>
        <header>
            <inertia-link :href="route('home')">Home</inertia-link>
            <inertia-link :href="route('search')">Search</inertia-link>
            <inertia-link v-if="!auth.user" :href="route('login')">Login</inertia-link>
        </header>
        <slot />
    </div>
</template>

<script>
export default {
    props: {
        auth: Object
    }
}
</script>
