<template>
  <div class="forgotPassword-page">
    <div class="forgotPassword-container">
      <form @submit.prevent="submitForm">
        <div class="forgotPassword-content">
          <p class="forgotPassword-notification">Please enter your email</p>
          <CustomInput label="Email" type="email" v-model="email" />
        </div>
        <div class="submit-btn">
          <button type="submit">Submit</button>
        </div>
      </form>
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
        email: ''
      };
    }
  };
  </script>