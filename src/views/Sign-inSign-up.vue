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
              <a href="#" class="forgot-password-link" title="">Forgot Password?</a>
            </div>
        </div>
              </div>
            </transition>
          </div>

    
        </div>
        <div class="about-column">
          <div class="about-section">
            <h2>About Us</h2>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut
              purus eget sapien egestas fermentum. Nullam nec nunc nec nunc
              fermentum.
            </p>
            <img src="../../public/img/logo.png" alt="About Us" style="width: 200px; height: auto;" />
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