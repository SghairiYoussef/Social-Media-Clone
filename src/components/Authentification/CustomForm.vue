<template>
  <div>
    <h3>{{ formTitle }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="input-row" v-for="(input, i) in inputs" :key="i">
        <custom-input
          v-model="input.value"
          :label="input.label"
          :type="input.type"
          @input="clearErrorMessage"
        />
      </div>
      <div class="error-message" v-if="error">{{ errorMessage }}</div>
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
      error: true
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
        return;
      }
      let data = new FormData();
      let action
      if(this.isSignup) {
        action = 'signup'
          const birthDateInput = this.inputs.find(input => input.label === 'Birth Date');
        const age = this.calculateAge(birthDateInput.value);
        if (age < 13) {
          this.errorMessage = 'You must be at least 13 years old to sign up';
          return;
        }
        const passwordInput = this.inputs.find(input => input.label === 'Password').value;
        if (!this.validatePassword(passwordInput)) {
          this.errorMessage = 'Password must be at least 8 characters long and contain both letters and numbers';
          return;
        }

        if (!this.checkPasswordMatch()) {
          this.errorMessage = 'Passwords do not match';
          return;
        }

          for (let i = 0; i < this.inputs.length - 1; i++) {
            data.append(this.inputs[i].label.replace(/\s/g, ''), this.inputs[i].value);
          }
      } else {
        action = 'login'
        for (let i = 0; i < this.inputs.length; i++) {
          data.append(this.inputs[i].label.replace(/\s/g, ''), this.inputs[i].value);
        }
      }
      axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=${action}`, data)
          .then(response => {
            // Handle successful login response
             this.errorMessage= response.data.message;
          })
          .catch(error => {
            // Handle login error
            console.error('Error signing in:', error);
          })
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








<style scoped>
.error-message {
  color: #dc8976;
  font-size: 20px;
  font-family: Arial, Helvetica, sans-serif;
  margin-top: 5px;
  margin-bottom: 10px;
  text-align: center;
}

.input-row {
  margin-bottom: 20px;
}

.submit-btn {
  text-align: center;
}

.submit-btn button {
  padding: 10px 20px;
  background-color: #7EA8BE;
  color: white;
  border: none;
  cursor: pointer;
}

.submit-btn button:hover {
  background-color: #28536B;
}

h3 {
  text-align: center;
}

</style>
