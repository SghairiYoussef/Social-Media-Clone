<template>
    <div class="sign-in-section">
      <div class="sign-in-form">
        <ul class="tab-control">
        </ul>
        <div class="login-form-section current" id="tab-1">
          <h3>Sign in</h3>
          <form @submit.prevent="login">
            <div class="input-row">
              <custom-input v-for="(input, i) in inputs" :key="i" v-model="input.value" :label="input.label" :type="input.type"/>
            </div>
            <div class="submit-btn">
              <button type="submit">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import CustomInput from '@/components/Authentification/CustomInput.vue';
  
  export default {
    data() {
      return {
        inputs: [
          {
            label: 'Username or Email',
            value: '',
            type: 'text'
          },
          {
            label: 'Password',
            value: '',
            type: 'password'
          }
        ]
      }
    },
    methods: {
      login() {
        console.log('Username/Email:', this.inputs[0].value);
        console.log('Password:', this.inputs[1].value);
      }
    },
    components: {
      CustomInput
    }
  }
  </script>
  
  <style scoped>
  .sign-in-section {
    width: 100%;
  }
  
  .sign-in-form {
    width: 100%;
  }
  </style>