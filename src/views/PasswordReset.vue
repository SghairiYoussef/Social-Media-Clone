<template>
    <div class="passwordReset-page">
      <div class="passwordReset-container">
        <form @submit.prevent="handleSubmit">
          <div class="passwordReset-content">
            <p class="passwordReset-notification">Please enter your new password</p>
            <div class="input-row" v-for="(input, i) in inputs" :key="i">
              <custom-input
                v-model="input.value"
                :label="input.label"
                :type="input.type"
                @input="clearErrorMessage"
              />
            </div>
          </div>
          <div class="error-message" v-if="error">{{ errorMessage }}</div>
          <div class="submit-btn">
            <button type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import CustomInput from '@/components/Authentification/CustomInput.vue';
  
  export default {
    components: {
      CustomInput
    },
    data() {
      return {
        inputs: [],
        errorMessage: '',
        error: false
      };
    },
    methods: {
      clearErrorMessage() {
        this.errorMessage = '';
      },
      handleSubmit() {
        if (!this.checkInputs()) {
          this.errorMessage = 'Please fill in all fields';
          this.error = true;
          return;
        }
        
        const passwordInput = this.inputs.find(input => input.label === 'Password').value;
        if (!this.validatePassword(passwordInput)) {
          this.errorMessage = 'Password must be at least 8 characters long and contain both letters and numbers';
          this.error = true;
          return;
        }
  
        if (!this.checkPasswordMatch()) {
          this.errorMessage = 'Passwords do not match';
          this.error = true;
          return;
        }
      },
      checkInputs() {
        for (let i = 0; i < this.inputs.length; i++) {
          if (!this.inputs[i].value) {
            return false;
          }
        }
        return true;
      },
      validatePassword(password) {
        const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        return regex.test(password);
      },
      checkPasswordMatch() {
        const password = this.inputs.find(input => input.label === 'Password').value;
        const repeatPassword = this.inputs.find(input => input.label === 'Repeat Password').value;
        return password === repeatPassword;
      }
    },
    created() {
      this.inputs = [
        { label: 'Password', value: '', type: 'password' },
        { label: 'Repeat Password', value: '', type: 'password' }
      ];
    }
  };
  </script>