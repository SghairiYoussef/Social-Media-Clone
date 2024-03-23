<template>
  <div class="input-field">
    <input :type="type" v-model="inputValue" :placeholder="label">
  </div>
</template>

<script>
export default {
  props: ['label', 'type', 'modelValue'],
  computed: {
    inputValue: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.$emit('update:modelValue', value);
      }
    }
  }
}
</script>