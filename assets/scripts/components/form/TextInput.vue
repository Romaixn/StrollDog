<template>
  <div>
    <label v-if="label" class="block text-sm font-medium text-gray-700" :for="id">{{ label }}:</label>
    <input :id="id" ref="input" v-bind="$attrs" :placeholder="label" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" :class="{ error: error }" :type="type" :value="value" @input="$emit('input', $event.target.value)">
    <div v-if="error" class="text-red-500">{{ error }}</div>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid';

export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    value: String,
    label: String,
    error: String,
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
    generateUuid(a){
        return a?(a^Math.random()*16>>a/4).toString(16):([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g,b)
    }
  },
}
</script>
