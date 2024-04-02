<template>
  <div class="authentication-page">
    <div class="login-page">
      <div class="login-content">
        <div class="form-column">
          <div class="login-popup">
            <button class="return-button" @click="returnToWelcomePage">
              <i class="fas fa-long-arrow-alt-left"></i>
            </button>
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
                      <input type="checkbox" name="remember" id="remember-checkbox" @change="updateRememberMe">
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
              INSAT Social Club is a platform that allows you to connect with your friends and family,
              share your thoughts, ideas, and memories with others.
              You can also chat with your friends in real-time and stay connected with them no matter where you are.
            </p>
            
            <div class="logo-container">
              <img src="../../public/img/logo.gif" alt="About Us" class="about-logo" />
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
      currentForm: 'signin',
    };
  },
  methods: {
    switchToSignin() {
      this.currentForm = 'signin';
    },
    switchToSignup() {
      this.currentForm = 'signup';
    },
    updateRememberMe(event) {
      this.$store.dispatch('updateRememberMe', event.target.checked);
    },
    returnToWelcomePage() {
      this.$router.push('/WelcomePage');
    }
}
};
</script>