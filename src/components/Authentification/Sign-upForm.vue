<template>
    <div class="signup-section">
      <div class="signup-form">
        <ul class="tab-control">
        </ul>
        <div class="signup-form-section current" id="tab-2">
          <h3>Sign up</h3>
          <form @submit.prevent="signup">
            <div class="input-row">
              <custom-input v-for="(input, i) in inputs" :key="i" v-model="input.value" :label="input.label" :type="input.type"/>
            </div>
            <div class="submit-btn">
              <button type="submit">Sign up</button>
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
            label: 'Full Name',
            value: '',
            type: 'text'
          },
          {
            label: 'Username',
            value: '',
            type: 'text'
          },
          {
            label: 'Age',
            value: '',
            type: 'number'
          },
          {
            label: 'Password',
            value: '',
            type: 'password'
          },
          {
            label: 'Repeat Password',
            value: '',
            type: 'password'
          }
        ]
      }
    },
    methods: {
      signup() {
        console.log('Full Name:', this.inputs[0].value);
        console.log('Username:', this.inputs[1].value);
        console.log('Age:', this.inputs[2].value);
        console.log('Password:', this.inputs[3].value);
        console.log('Repeat Password:', this.inputs[4].value);
      }
    },
    components: {
      CustomInput
    }
  }
  </script>
  
  <style scoped>
  .signup-section {
    width: 100%;
  }
  
  .signup-form {
    width: 100%;
  }
  
  </style>