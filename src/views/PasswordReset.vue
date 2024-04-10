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
                :disabled="isReset"
                @input="clearErrorMessage"
            />
          </div>
        </div>
        <div class="resetError-width">
          <div class="alert alert-warning" role="alert" v-if="errorMessage">{{ errorMessage }}</div>
          <div class="alert alert-success" role="alert" v-if="isReset && !input && !errorMessage">Password reset completed successfully. You will be redirected to login page in {{ countdown }} seconds </div>
        </div>
        <div class="submit-btn">
          <button type="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import CustomInput from '@/components/Authentification/CustomInput.vue';

import axios  from "axios";
export default {
  components: {
    CustomInput
  },
  data() {
    return {
      inputs: [],
      errorMessage: '',
      error: false,
      resetPasswordToken : this.$route.params.resetPasswordToken,
      isReset: false,
      countdown: 5
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
        this.errorMessage = 'Password must be 8+ characters with letters and numbers';
        this.error = true;
        return;
      }

      if (!this.checkPasswordMatch()) {
        this.errorMessage = 'Passwords do not match';
        this.error = true;
        return;
      }
      let data= new FormData();
      data.append('password', this.inputs[0].value);
      data.append('resetPasswordToken', this.resetPasswordToken);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=resetPassword', data)

          .then(response => {
            console.log(response.data.message);
            if (!response.data.success) {
              this.errorMessage = 'Invalid token';
              this.error = true;
              return;
            }
            // Handle successful password reset
            if (response.data.success) {
              this.isReset = true;
              this.inputs.forEach(input => input.value = '');
              const interval = setInterval(() => {
                if (this.countdown > 0) {
                  this.countdown--;
                } else {
                  clearInterval(interval);
                  this.$router.push('/login');
                }
              }, 1000);
            }
          })
          .catch(error => {
            console.error('Error signing in:', error);
          });


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