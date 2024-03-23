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




<style scoped>
.input-field {
  position: relative;
  margin-bottom: 20px;
}

.input-field input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

.input-icon {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  font-size: 20px;
  color: #ccc;
}

.icon-user::before {
  content: '\f007';
}

.icon-lock::before {
  content: '\f023';
}

</style>