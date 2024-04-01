<template>
  <div :class="{'input-field': true, 'input-field-disabled': disabled}">
    <input :type="type" :disabled="disabled" v-model="inputValue" :placeholder="label">
  </div>
</template>

<script>
export default {
  props: ['label', 'type', 'modelValue', 'disabled'],
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