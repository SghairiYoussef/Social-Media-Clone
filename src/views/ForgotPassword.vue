<template>
  <div class="forgotPassword-page">
    <div class="forgotPassword-container">
      <form @submit.prevent="submitForm">
        <div class="forgotPassword-content" v-if="!isSent">
          <p class="forgotPassword-notification">Please enter your email</p>
          <CustomInput label="Email"
                       type="email"
                       v-model="email"
                       @input="clearErrorMessage" />
        </div>
        <div class="forgotError-width">
          <div class="alert alert-warning" role="alert" v-if="errorMessage">{{ errorMessage }}</div>
        </div>
        <div class="urlSent" v-if="isSent">
          <div class="alert alert-success" role="alert">Password reset link sent to your email</div>
        </div>
        <div class="submit-btn" v-if="!isSent">
          <button type="submit" :disabled="isSubmitting" class="submit-button">Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import CustomInput from '@/components/Authentification/CustomInput.vue';
import axios from 'axios';
export default {
  components: {
    CustomInput
  },
  data() {
    return {
      email: '',
      errorMessage: '',
      error: false,
      isSent: false,
      isSubmitting: false
    };
  },
  methods: {
    submitForm() {
      if (!this.email) {
        this.errorMessage = 'Enter your email please';
        this.error = true;
        return;
      }
      this.isSubmitting = true;
      let data = new FormData();
      data.append('email', this.email);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=resetPasswordRequest', data)
        .then(response => {
          // Handle successful login response
          console.log(response.data.message)
          if (!response.data.success){
            this.errorMessage = 'Email does not exist';
            this.error = true;
            this.isSubmitting = false;
          }
          else {
            this.isSent = true;
          }
        })
        .catch(error => {
          console.error('Error signing in:', error);
        });
    },
    clearErrorMessage() {
      this.errorMessage = '';
      this.error = false;
      this.isSent = false;
    }
  }
};
</script>

<style scoped>
.submit-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}
</style>