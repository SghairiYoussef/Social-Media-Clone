<template>
    <div class="authentication-page">
      <div class="login-page">
        <div class="login-popup">
          <div class="toggle-buttons">
            <button @click="switchToSignin" :class="{ active: currentForm === 'signin' }">Sign In</button>
            <button @click="switchToSignup" :class="{ active: currentForm === 'signup' }">Sign Up</button>
          </div>
          <div class="login-content">
            <div class="row">
              <LoginForm v-if="currentForm === 'signin'" />
              <SignupForm v-else />
            </div>
          </div>
        </div>
        <div class="footer-section">
          <div class="container">
            <ul>
              <li><a href="ContactUs.html" title="">Contact us</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import LoginForm from '@/components/Authentification/Sign-inForm.vue'
  import SignupForm from '@/components/Authentification/Sign-upForm.vue'
  
  export default {
    components: {
      LoginForm,
      SignupForm
    },
    data() {
      return {
        currentForm: 'signin'
      }
    },
    methods: {
      switchToSignin() {
        this.currentForm = 'signin';
      },
      switchToSignup() {
        this.currentForm = 'signup';
      }
    }
  }
  </script>
  
  <style scoped>
  .toggle-buttons {
    display: flex;
    justify-content: flex-end;
  }
  
  .toggle-buttons button {
    margin-left: 10px;
  }
  
  .toggle-buttons button.active {
    font-weight: bold;
  }
  </style>
  