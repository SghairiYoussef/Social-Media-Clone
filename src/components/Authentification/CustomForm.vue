<template>
  <div>
    <h3>{{ formTitle }}</h3>
    <form @submit.prevent="handleSubmit">
      <div class="input-row" v-for="(input, i) in inputs" :key="i">
        <custom-input v-model="input.value" :label="input.label" :type="input.type" />
      </div>
      <div class="submit-btn">
        <button type="submit">{{ submitButtonText }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import CustomInput from '@/components/Authentification/CustomInput.vue';

export default {
  props: {
    isSignup: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      inputs: [],
      formTitle: '',
      submitButtonText: ''
    };
  },
  methods: {
    handleSubmit() {
      console.log(this.inputs);
    }
  },
  components: {
    CustomInput
  },
  created() {
    if (this.isSignup) {
      this.inputs = [
        { label: 'Full Name', value: '', type: 'text' },
        { label: 'Username', value: '', type: 'text' },
        { label: 'Birth Date', value: '', type: 'date' },
        { label: 'Email', value: '', type: 'email' },
        { label: 'Password', value: '', type: 'password' },
        { label: 'Repeat Password', value: '', type: 'password' }
      ];
      this.formTitle = 'Sign Up';
      this.submitButtonText = 'Sign Up';
    } else {
      this.inputs = [
        { label: 'Username or Email', value: '', type: 'text' },
        { label: 'Password', value: '', type: 'password' }
      ];
      this.formTitle = 'Sign In';
      this.submitButtonText = 'Sign In';
    }
  }
};
</script>