<template>
  <div>
    <h3 class="formTitle">{{ formTitle }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="input-row" v-for="(input, i) in inputs" :key="i">
        <custom-input
          v-model="input.value"
          :label="input.label"
          :type="input.type"
          @input="clearErrorMessage"
        />
      </div>
      <div class="alert alert-warning" role="alert" v-if="errorMessage">{{ errorMessage }}</div>
      <div class="submit-btn">
        <button type="submit">{{ submitButtonText }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import CustomInput from '@/components/Authentification/CustomInput.vue';
import axios from 'axios';

export default {
  props: {
    isSignup: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      inputs: [],
      formTitle: '',
      submitButtonText: '',
      errorMessage: '',
      error: false
    };
  },
  methods: {
    checkPasswordMatch() {
      if (this.isSignup) {
        const password = this.inputs.find(input => input.label === 'Password').value;
        const repeatPassword = this.inputs.find(input => input.label === 'Repeat Password').value;
        return password === repeatPassword;
      }
      return true;
    },
    checkInputs() {
      for (let i = 0; i < this.inputs.length; i++) {
        if (!this.inputs[i].value) {
          return false;
        }
      }
      return true;
    },
    clearErrorMessage() {
      this.errorMessage = '';
    },
    validatePassword(password) {
      const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      return regex.test(password);
    },
    calculateAge(birthDate) {
      const today = new Date();
      const dob = new Date(birthDate);
      let age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }
      return age;
    },
    handleSubmit() {
      if (!this.checkInputs()) {
        this.errorMessage = 'Please fill in all fields';
        this.error = true;
        return;
      }
      let Signup = new FormData();
      let action;
      if (this.isSignup) {
        action = 'signup';
        const birthDateInput = this.inputs.find(input => input.label === 'Birth Date');
        const age = this.calculateAge(birthDateInput.value);
        if (age < 13) {
          this.errorMessage = 'You must be at least 13 years old to sign up';
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
        for (let i = 0; i < this.inputs.length - 1; i++) {
          Signup.append(this.inputs[i].label.replace(/\s/g, ''), this.inputs[i].value);
        }
        // Dispatch action to set Signup data in Vuex store
        this.$store.dispatch('setSignupFormData', Signup);
      } else {
        action = 'login';
        for (let i = 0; i < this.inputs.length; i++) {
          Signup.append(this.inputs[i].label.replace(/\s/g, ''), this.inputs[i].value);
        }
      }
      axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=${action}`, Signup)
        .then(response => {
          // Handle successful login response
          this.errorMessage = response.data.message;
          if (this.isSignup && response.data.success) {
            this.$router.push('/login/verifyEmail');
          }
        })
        .catch(error => {
          // Handle login error
          console.error('Error signing in:', error);
        });
    },
  },
  components: {
    CustomInput
  },
  created() {
    if (this.isSignup) {
      this.inputs = [
        { label: 'Full Name', value: '', type: 'text' },
        { label: 'Username', value: '', type: 'text' },
        { label: 'Birth Date', value: '', type: 'date' },
        { label: 'Email', value: '', type: 'email' },
        { label: 'Password', value: '', type: 'password' },
        { label: 'Repeat Password', value: '', type: 'password' }
      ];
      this.formTitle = 'Sign Up';
      this.submitButtonText = 'Sign Up';
    } else {
      this.inputs = [
        { label: 'Username', value: '', type: 'text' },
        { label: 'Password', value: '', type: 'password' }
      ];
      this.formTitle = 'Sign In';
      this.submitButtonText = 'Sign In';
    }
  }
};
</script>
