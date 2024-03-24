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
              Jakakokalareta marshalli asistencia marshalli meska paramueta para messi messi messi messi messi messi messi messi i menci messi ankara messi ankara messi ANKARA MESSI ANKARA MESSI ANKARA MESSI ANKARA MESSI UENA MESSI ANKARA MESSI ANKARA MESSI ANKARA MESSI ANKARA MESSI
A N K A R A M E S S I
GOLGOL GOLGOL GOL !!! GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL G O L !!!!! GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL GOLGOL G O L ! ! !
INKA IPLA INKA IPLA !!! UOBOBUNGIMACCIMA BROBOUBUIAIMAŹIMA BROUEIŻMAIŻŚOOOOO BROUEIŹMAI INKA IPLA WENEZUAUA INKA IPLA UENEZUAUA MESSI MESSI MESSI PORA MESSI MESSI MESS PORA MESS PORA GOL MESS PORA GOL GOL GOL GOL GOL GOL MESS PORA GOL MESSI GOL MESSI GOL MESS DOR POL MEZ POL MEZ IANKARA MESSI MESSI MESS I MESS I MESS I MESS I MESS I MESS I MESS I MESS I MESS I MESS I MESS I TOTTI TOTTI TOTTI TOTTI TOTTI MESSI TOTTI MESSI TOT ITOTTI TOTTI TOTTI MESS TOTTI MESS ! ALETURA ZAMEZAMES INKA IPLA AASPAKAKULAE Inka Ipla ALKAEFATTA MESSI PARKA KOMPARERA MARADONA PARKA QUE GOL SASEMLALANLUSIA SI , SI , SI !!! UIJANTASI ASPATAGULAR
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