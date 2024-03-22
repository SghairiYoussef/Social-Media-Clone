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


<style scoped>
.authentication-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background: #f6F0ED;
}

.login-page {
  width: 100%;
  max-width: 400px;
  background: #BBB193;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-popup {
  padding: 30px;
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
  color: #28536B;
  font-size: 16px;
  cursor: pointer;
  outline: none;
}


.toggle-buttons button.active {
  color: #C2948A;
}

.login-content {
  padding: 20px;
  border: 1.5px solid #f1f1f1;
  border-radius: 5px;
}

.form-section {
  margin-bottom: 20px;
}

.footer-section {
  padding: 20px;
  border-top: 1px solid #f1f1f1;
  background: #f9f9f9;
  border-radius: 0 0 5px 5px;
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

.agree-terms-section {
  display: flex;
  align-items: center;
}

.agree-terms-section input[type="checkbox"] {
  display: none; 
}

.agree-terms-section label {
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

.agree-terms-section input[type="checkbox"]:checked + label {
  background-color: #007bff; 
  border-color: #007bff;
}

.agree-terms-section label::after {
  content: "\2713";
  font-family: Arial, sans-serif;
  color: white;
  font-size: 14px;
  font-weight: bold;
  opacity: 0;
  transition: opacity 0.2s ease-in-out; 
}

.agree-terms-section input[type="checkbox"]:checked + label::after {
  opacity: 1; 
}



.container {
  display: flex;
  justify-content: center;
}

.container ul {
  display: flex;
  list-style: none;
  padding: 0;
}

.container ul li {
  margin-right: 10px;
}

.container ul li a {
  color: #007bff;
  text-decoration: none;
}

.container ul li a:hover {
  text-decoration: underline;
}

.no-pdd {
  padding: 0;
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

  .agree-terms-section {
    flex-direction: column;
    align-items: flex-start;
  }

  .container {
    padding: 10px;
  }
}


</style>
