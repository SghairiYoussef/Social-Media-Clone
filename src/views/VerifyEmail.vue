<template>
    <div class="verifyEmail-page">
      <div class="verifyEmail-container">
        <div class="verifyEmail-content">
          <p class="verifyEmail-notification">A verification email has been sent to your email address. Please check it.</p>
          <CustomInput label="Verification Code" type="text" v-model="verificationCode" />
        </div>
        <div class="verifySubmit-btn">
          <button type="submit" @click="submitForm">Submit</button>
          <button :disabled="Cooldown > 0" @click="resendVerification" :class="{ 'disabled': Cooldown > 0 }">
            {{ Cooldown > 0 ? `Resend in ${Cooldown} seconds` : 'Resend' }}
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import CustomInput from '@/components/Authentification/CustomInput.vue';
  
  export default {
    components: {
      CustomInput
    },
    data() {
      return {
        verificationCode: '',
        Cooldown: 60
      };
    },
    created() {
      this.startCooldownTimer();
    },
    methods: {
      resendVerification() {
        this.Cooldown = 60;
        this.startCooldownTimer();
      },
      startCooldownTimer() {
        const timerInterval = setInterval(() => {
          if (this.Cooldown > 0) {
            this.Cooldown--;
          } else {
            clearInterval(timerInterval);
          }
        }, 1000);
      }
    }
  };
  </script>