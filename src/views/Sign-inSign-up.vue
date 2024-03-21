<template>
  <div class="authentication-page">
    <div class="login-page">
      <div class="login-popup">
        <div class="toggle-buttons">
          <button @click="switchToSignin" :class="{ active: currentForm === 'signin' }">Sign In</button>
          <button @click="switchToSignup" :class="{ active: currentForm === 'signup' }">Sign Up</button>
        </div>
        <div class="login-content">
          <div v-if="currentForm === 'signin'" class="form-section">
            <CustomForm :isSignup="false" />
          </div>
          <div v-else class="form-section">
            <CustomForm :isSignup="true" />
          </div>
        </div>
      </div>
      <div class="footer-section">
        <div class="col-lg-12 no-pdd">
          <div v-if="currentForm === 'signin'" class="remember-me-section">
            <div class="checkbox-section">
              <input type="checkbox" name="remember" id="remember-checkbox">
              <label for="remember-checkbox">
                <span></span>
              </label>
              <small>Remember me</small>
            </div>
            <a href="#" class="forgot-password-link" title="">Forgot Password?</a>
          </div>
        </div>
        <div class="col-lg-12 no-pdd">
          <div class="agree-terms-section">
            <div v-if="currentForm === 'signup'" class="checkbox-section">
              <input type="checkbox" name="agree-terms" id="agree-terms-checkbox">
              <label for="agree-terms-checkbox">
                <span></span>
              </label>
              <small>Yes, I understand and agree to the terms & conditions.</small>
            </div>
          </div>
        </div>
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
import CustomForm from '@/components/Authentification/CustomForm.vue';

export default {
  components: {
    CustomForm
  },
  data() {
    return {
      currentForm: 'signin'
    };
  },
  methods: {
    switchToSignin() {
      this.currentForm = 'signin';
    },
    switchToSignup() {
      this.currentForm = 'signup';
    }
  }
};
</script>
