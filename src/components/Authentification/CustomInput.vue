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
  
<style scoped>
.input-field {
  position: relative;
  width: 100%;
}

.input-field input {
  padding-right: 30px; 
}

.input-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  font-size: 18px;
}
</style>