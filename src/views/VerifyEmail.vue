<template>
  <div class="verifyEmail-page">
    <div class="verifyEmail-container">
      <div class="verifyEmail-content">
        <p class="verifyEmail-notification">A verification email has been sent to your email address. Please check it.</p>
        <custom-input label="Verification Code" type="text" v-model="verificationCode" />
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
      errorMessage: ''
    };
  },
  created() {
    this.startCooldownTimer();
    let Signup = this.getSignupFormData();
    axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=verify', Signup)
      .then(response => {
        console.log(response.data.message);
        this.errorMessage = response.data.message;
      })
      .catch(error => {
        console.error('Error signing in:', error);
      });
  },
  methods: {
    ...mapGetters(['getSignupFormData']),
    ...mapActions(['setEmailVerified']),
    resendVerification() {
      this.cooldown = 60;
      this.startCooldownTimer();
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
    handleVerification() {
      let Signup = this.getSignupFormData();
      axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=verificationProcess', Signup)
        .then(response => {
          this.$store.dispatch('setEmailVerified', true);
          console.log(response.data.message);
          this.$router.push('/login');
        })
        .catch(error => {
          console.error('Error verifying email:', error);
        });
    }
  }
};
</script>
