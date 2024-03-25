<template>
  <div class="authentication-page">
    <div class="login-page">
      <div class="login-content">
        <div class="form-column">
          <div class="login-popup">
            <div class="toggle-buttons">
              <button @click="switchToSignin" :class="{ active: currentForm === 'signin' }">Sign In</button>
              <button @click="switchToSignup" :class="{ active: currentForm === 'signup' }">Sign Up</button>
            </div>
            <transition name="fade" mode="out-in">
              <div :key="currentForm" class="form-section">
                <div v-if="currentForm === 'signin'">
                  <CustomForm :isSignup="false" />
                </div>
                <div v-else>
                  <CustomForm :isSignup="true" />
                </div>
                <div class="col-lg-12 no-pdd">
                  <div v-if="currentForm === 'signin'" class="remember-me-section" key="signin-remember">
                    <div class="checkbox-section">
                      <input type="checkbox" name="remember" id="remember-checkbox">
                      <label for="remember-checkbox">
                        <span></span>
                      </label>
                      <small>Remember me</small>
                    </div>
                    <router-link to="/login/forgotPassword" class="forgot-password-link" title="">Forgot Password?</router-link>
                  </div>
                </div>
              </div>
            </transition>
          </div>
        </div>
        <div class="about-column">
          <div class="about-section">
            <h2>About Us</h2>
            <div class="separator"></div>
            <p>
              Messi. Messi. Messi. Immens Messi. Encara Messi. Encara Messi. ANKARA MESSI. Encara Messi. Encara Messi.
Gol. Gol. Gol. Gol. Gol. Gol. Gol. Gol. Gol.
            </p>
            
            <div class="logo-container">
              <img src="../../public/img/logo.png" alt="About Us" class="about-logo" />
            </div>
          </div>
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