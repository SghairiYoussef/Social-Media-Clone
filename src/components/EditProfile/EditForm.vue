<template>
  <div class="user-details-card card h-100">
    <div class="card-body">
      <!-- Personal Details Section -->
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <h6 class="section-title mb-2 text-primary">Personal Details</h6>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" v-for="(field, index) in personalDetailsFields" :key="index">
          <div class="form-group">
            <label :for="field.id">{{ field.label }}</label>
            <CustomInput :type="field.type" 
                         :label="field.placeholder" 
                         v-model="field.value"
                         @input="clearErrorMessage"
            />
          </div>
        </div>
      </div>
      <!-- Email Section -->
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <h6 class="section-title mb-2 text-primary">Email</h6>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" v-for="(field, index) in emailFields" :key="index">
          <div class="form-group">
            <label :for="field.id">{{ field.label }}</label>
            <CustomInput :type="field.type" 
                         v-model="field.value" 
                         :label="field.placeholder"
                         @input="clearErrorMessage"
            />
          </div>
        </div>
      </div>
      <!-- Password Change Section -->
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <h6 class="section-title mb-2 text-primary">Password</h6>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" v-for="(field, index) in passwordFields" :key="index">
          <div class="form-group">
            <label :for="field.id">{{ field.label }}</label>
            <CustomInput :type="field.type" 
                         v-model="field.value" 
                         :label="field.placeholder"
                         @input="clearErrorMessage"
            />
          </div>
        </div>
      </div>
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" :style="{ height: errorMessage ? '50px' : 'auto' }">
          <div class="text-right">
            <button type="button" class="btn btn-secondary">Cancel</button>
            <button type="button" class="btn btn-primary" @click="updateProfile">Update</button>
          </div>
          <div v-if="errorMessage" class="mt-3 alert alert-danger" role="alert">{{ errorMessage }}</div>
        </div>
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
      personalDetailsFields: [
        { id: 'fullName', label: 'Full Name', type: 'text', placeholder: 'Enter new fullName', value: ''},
        { id: 'username', label: 'Username', type: 'text', placeholder: 'Enter new username', value: ''},
        { id: 'birthDate', label: 'Birth Date', type: 'date', placeholder: 'Enter birth date', value: ''},
        { id: 'bio', label: 'Bio Description', type: 'textarea', placeholder: 'Enter bio description', value: ''}
      ],
      emailFields: [
        { id: 'eMail', label: 'Email', type: 'email', placeholder: 'Enter new email', value: ''},
        { id: 'password', label: 'Password', type: 'password', placeholder: 'Enter your current password', value: ''}
      ],
      passwordFields: [
        { id: 'oldPassword', label: 'Old Password', type: 'password', placeholder: 'Enter old password', value: ''},
        { id: 'newPassword', label: 'New Password', type: 'password', placeholder: 'Enter new password', value: ''},
        { id: 'repeatNewPassword', label: 'Repeat New Password', type: 'password', placeholder: 'Repeat new password', value: ''}
      ],
      errorMessage: ''
    }
  },
  methods: {
    clearErrorMessage() {
      this.errorMessage = '';
    },
    checkPasswordMatch() {
      const password = this.passwordFields.find(input => input.label === 'New Password').value;
      const repeatPassword = this.passwordFields.find(input => input.label === 'Repeat New Password').value;
      return password === repeatPassword;
    },
    validatePassword(password) {
      const regex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
      return regex.test(password);
    },
    calculateAge(birthDate) {
      const today = new Date();
      const dob = new Date(birthDate);
      let age = today.getFullYear() - dob.getFullYear();
      const monthDiff = today.getMonth() - dob.getMonth();
      if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
        age--;
      }
      return age;
    },
    checkInputs(inputFields) {
      let count = 0;
      for (let i = 0; i < inputFields.length; i++) {
        if (inputFields[i].value) {
          count++;
        }
      }
      return count;
    },
    updateProfile() {
      console.log('Profile Updated');
      let update = new FormData();
      //let action; 
      //const emailCount = this.checkInputs(this.emailFields);
      //const passwordCount = this.checkInputs(this.passwordFields);
      const fullNameField = this.personalDetailsFields.find(field => field.id === 'fullName');
      if (fullNameField.value) {
        update.append('fullName', fullNameField.value);
      }
      const birthDateField = this.personalDetailsFields.find(field => field.id === 'birthDate');
      if (birthDateField.value) {
        const age = this.calculateAge(birthDateField.value);
        if (age < 13) {
          this.errorMessage = 'You must be at least 13 years old';
          return;
        }
        else {
          update.append('birthDate', birthDateField.value);
        }
      }
    }
  }
}
</script>