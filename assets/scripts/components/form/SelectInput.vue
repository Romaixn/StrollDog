<template>
  <div>
    <label v-if="label" class="block text-sm font-medium text-gray-700" :for="id">{{ label }}</label>
    <select :id="id" ref="input" v-model="selected" v-bind="$attrs" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ error: error }">
      <slot />
    </select>
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
        return `select-input-${uuid()}`
      },
    },
    value: [String, Number, Boolean],
    label: String,
    error: String,
  },
  data() {
    return {
      selected: this.value,
    }
  },
  watch: {
    selected(selected) {
      this.$emit('input', selected)
    },
  },
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
  },
}
</script>
