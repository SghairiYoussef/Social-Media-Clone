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

<style scoped>
.authentication-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: #f6f0ed;
}
.col-lg-12 {
  margin-top: 10px;
}

.login-page {
  width: 100%;
  max-width: 800px; 
  display: flex;
  flex-direction: column;
  background: #eaeaea; 
  border-radius: 10px; 
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
}
.login-content {
  display: flex;
}

.form-column {
  flex: 1;
}

.about-column {
  flex: 1;
}

.about-section {
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}


.login-popup {
  padding: 30px;
  height: 690px;
  overflow: auto;
}

.toggle-buttons {
  display: flex;
  justify-content: space-between;
  margin-bottom: 30px;
}

.toggle-buttons button {
  padding: 10px 20px;
  border: none;
  background: transparent;
  color: #28536b;
  font-size: 23px;
  cursor: pointer;
  outline: none;
  border-radius: 5px; 
  transition: background-color 0.3s ease; 
}

.toggle-buttons button.active {
  color: #c2948a;
}

.toggle-buttons button:hover {
  background-color: #dcdcdc; 
}

.login-content {
  padding: 20px;
  border: 1.5px solid #f1f1f1;
  border-radius: 10px; 
}

.form-section {
  margin-bottom: 20px;
}

.footer-section {
  padding: 20px;
  border-top: 1px solid #f1f1f1;
  background: #f9f9f9;
}

.remember-me-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.checkbox-section {
  display: flex;
  align-items: center;
}

.checkbox-section input[type="checkbox"] {
  display: none;
}

.checkbox-section label {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 15px;
  height: 15px;
  background-color: #f5f5f5;
  border: 2px solid #d8d8d8;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out, border-color 0.2s ease-in-out;
}

.checkbox-section input[type="checkbox"]:checked + label {
  background-color: #007bff;
  border-color: #007bff;
}

.checkbox-section label::after {
  content: "\2713";
  font-family: Arial, sans-serif;
  color: white;
  font-size: 14px;
  font-weight: bold;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

.checkbox-section input[type="checkbox"]:checked + label::after {
  opacity: 1;
}

.forgot-password-link {
  color: #007bff;
  font-size: 14px;
  text-decoration: none;
}


.no-pdd {
  padding: 0;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease-in-out;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

@media (max-width: 767px) {
  .login-page {
    width: 100%;
    border-radius: 0;
  }
}

@media (max-width: 575px) {
  .login-popup {
    padding: 20px;
  }

  .toggle-buttons {
    flex-direction: column;
  }

  .toggle-buttons button {
    width: 100%;
    margin-bottom: 10px;
  }

  .login-content {
    padding: 10px;
  }

  .footer-section {
    padding: 10px;
  }

  .remember-me-section {
    flex-direction: column;
    align-items: flex-start;
    font-size: 30px;
  }
.container {
    flex-direction: column;
    align-items: center;
  }
  
}
</style>
