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
            <CustomInput :type="field.type" :label="field.placeholder" :modelValue="field.value"/>
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
            <CustomInput :type="field.type" :modelValue="field.value" :label="field.placeholder"/>
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
            <CustomInput :type="field.type" :modelValue="field.value" :label="field.placeholder"/>
          </div>
        </div>
      </div>
      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="text-right">
            <button type="button" class="btn btn-secondary">Cancel</button>
            <button type="button" class="btn btn-primary" @click="updateProfile">Update</button>
          </div>
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
        { id: 'username', label: 'Username', type: 'text', placeholder: 'Enter new userName', value: ''},
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
      ]
    }
  },
  methods: {
    updateProfile() {
      console.log('Profile Updated');
    }
  }
}
</script>