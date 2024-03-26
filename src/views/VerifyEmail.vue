<template>
  <div class="verifyEmail-page">
    <div class="verifyEmail-container">
      <div class="verifyEmail-content">
        <p class="verifyEmail-notification">A verification email has been sent to your email address. Please check it.</p>
        <custom-input label="Verification Code" type="text" v-model="verificationCode" @input="clearErrorMessage" />
      </div>
      <div class="verifyError-width">
          <div class="alert alert-warning" role="alert" v-if="errorMessage">{{ errorMessage }}</div>
          <div class="alert alert-success" role="alert" v-if="isResend && !input && !errorMessage">Verification code has been resent</div>
        </div>
      <div class="verifySubmit-btn">
        <button type="submit" @click="handleVerification">Submit</button>
        <button :disabled="cooldown > 0" @click="resendVerification" :class="{ 'disabled': cooldown > 0 }">
          {{ cooldown > 0 ? `Resend in ${cooldown} seconds` : 'Resend' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import CustomInput from '@/components/Authentification/CustomInput.vue';
import axios from 'axios';
import { mapGetters } from 'vuex';
import { mapActions } from 'vuex';

export default {
  components: {
    CustomInput
  },
  data() {
    return {
      verificationCode: '',
      cooldown: 60,
      errorMessage: '',
      isResend: false
    };
  },
  created() {
    this.startCooldownTimer();
    this.sendVerificationEmail();
  },
  methods: {
    ...mapGetters(['getSignupFormData']),
    ...mapActions(['setEmailVerified']),
    clearErrorMessage() {
      this.errorMessage = '';
      this.isResend = false;
    },
    resendVerification() {
      this.cooldown = 60;
      this.isResend = true;
      this.startCooldownTimer();
      this.sendVerificationEmail();
    },
    startCooldownTimer() {
      const timerInterval = setInterval(() => {
        if (this.cooldown > 0) {
          this.cooldown--;
        } else {
          clearInterval(timerInterval);
        }
      }, 1000);
    },
    sendVerificationEmail() {
      let Signup = this.getSignupFormData();
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=verify', Signup)
          .then(response => {
            // Handle successful login response
            this.code = response.data.code;
          })
          .catch(error => {
            console.error('Error signing in:', error);
          });
    },
    handleVerification() {
      let Signup = this.getSignupFormData();
      Signup.append('code', this.code);
      Signup.append('verificationCode', this.verificationCode);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=verificationProcess', Signup)
        .then(response => {
          // Handle successful login response
          this.$store.dispatch('setEmailVerified', true);
          this.errorMessage= response.data.message;
          if (response.data.message == 'Signed up successfully') {
            this.$router.push('/login');
          }
        })
        .catch(error => {
          console.error('Error verifying email:', error);
        });
    }
  }
};
</script>
