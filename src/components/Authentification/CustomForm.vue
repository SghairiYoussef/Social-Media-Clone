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
      <div class="alert alert-success" role="alert" v-if="isEmailVerified && !input && !errorMessage && formTitle === 'Sign In'">Signed up successfully</div>
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
import { mapGetters } from 'vuex';
import { mapState } from 'vuex';

export default {
  props: {
    isSignup: {
      type: Boolean,
      required: true
    },
  },
  data() {
    return {
      inputs: [],
      formTitle: '',
      submitButtonText: '',
      errorMessage: '',
      error: false,
      input: false
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
      this.input = true;
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
        this.$store.dispatch('setSignupFormData', Signup);
      } else {
        action = 'login';
        for (let i = 0; i < this.inputs.length; i++) {
          Signup.append(this.inputs[i].label.replace(/\s/g, ''), this.inputs[i].value);
        }
        Signup.append('rememberMe', this.rememberMe);
      }
      axios.defaults.withCredentials = true;

      axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=${action}`, Signup)
          .then(response => {
            if (response.data.message === 'Failed to log in user' && action === 'login') {
                this.errorMessage = response.data.message;
                this.error = true;
              }
            if (action === 'login' && response.data.success) {
              
              sessionStorage.setItem('sessionId', response.data.sessionID);
              sessionStorage.setItem('userId', response.data.userId);
              if(response.data.isAdmin){
                this.$router.push('/admin');
              }
              else {
                this.$router.push('/Home');
              }
            }
            if (this.isSignup && response.data.success) {
              this.$router.push('/login/verifyEmail');
            }
            else if (this.isSignup && !response.data.success) {
              this.errorMessage = response.data.message;
              this.error = true;
            }

          })

          .catch(error => {
            console.error('Error signing in:', error);
          });
    },
  },
  components: {
    CustomInput
  },
  computed: {
    ...mapGetters(['isEmailVerified']),
    ...mapState(['rememberMe'])
  },
  watch: {
    isEmailVerified(newValue) {
      this.isEmailVerified = newValue;
    }
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
