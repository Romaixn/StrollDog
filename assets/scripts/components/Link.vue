<template>
  <div>
    <inertia-link :href="route" :class="class"> Sign in </inertia-link>
  </div>
</template>


<script setup>
const props = defineProps({
    route: Function,
    class: String,
})
</script>
