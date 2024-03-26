<template>
  <div class="forgotPassword-page">
    <div class="forgotPassword-container">
      <form @submit.prevent="submitForm">
        <div class="forgotPassword-content">
          <p class="forgotPassword-notification">Please enter your email</p>
          <CustomInput label="Email" 
          type="email" 
          v-model="email" 
          @input="clearErrorMessage" />
        </div>
        <div class="forgotError-width">
          <div class="alert alert-warning" role="alert" v-if="errorMessage">{{ errorMessage }}</div>
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
import axios from 'axios';
export default {
  components: {
    CustomInput
  },
  data() {
    return {
      email: '',
      errorMessage: '',
      error: false
    };
  },
  methods: {
    submitForm() {
      if (!this.email) {
        this.errorMessage = 'Enter your email please';
        this.error = true;
        return;
      }
      this.$store.dispatch('setEmail', this.email);
      let data = new FormData();
      data.append('email', this.email);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=resetPasswordRequest', data)
        .then(response => {
          // Handle successful login response
          console.log(response.data.message);
        })
        .catch(error => {
          console.error('Error signing in:', error);
        });
    },
    clearErrorMessage() {
      this.errorMessage = '';
    }
  }
};
</script>
