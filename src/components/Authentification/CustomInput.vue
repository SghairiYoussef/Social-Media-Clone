<template>
    <div class="input-field">
      <input :type="type" v-model="inputValue" :placeholder="label">
      <i class="input-icon" :class="iconClass"></i>
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
    },
    iconClass() {
      return this.type === 'text' ? 'icon-user' : 'icon-lock';
    }
  }
}
</script>