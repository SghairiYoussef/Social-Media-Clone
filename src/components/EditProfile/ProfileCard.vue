<template>
  <div class="card h-100">
    <div class="card-body">
      <div class="account-settings">
        <div class="user-profile">
          <div class="user-avatar">
            <img :src="avatarUrl" alt="ProfileImage" class="ProfileImage img-fluid rounded-circle">
            <label for="avatarUpload" class="btn btn-outline-danger mt-2">Upload Image</label>
            <input type="file" id="avatarUpload" accept="image/*" @change="handleAvatarChange" style="display: none;">
          </div>
          <h5 class="username">{{ username }}</h5>
          <h6 class="user-email"><a :href="'mailto:' + email">{{ email }}</a></h6>
        </div>
        <div class="about">
          <h5>About</h5>
          <p>{{ bio }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      username: '',
      email: '',
      bio: 'No bio provided',
      avatarUrl: require('../../../public/img/noProfileImage.jpg')
    };
  },
  computed: {
    ...mapState(['isModified'])
  },
  mounted() {
    this.fetchUserData();
  },
  watch: {
    isModified() {
      if (this.isModified) {
        this.fetchUserData();
      }
    }
  },
  methods: {
    ...mapActions(['setIsModified']),
    fetchUserData() {
      let data = new FormData();
      let sessionId = sessionStorage.getItem('sessionId');
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/EditProfileAPI.php?action=DetailsFetch', data)
        .then(response => {
          console.log(response.data.data);
          if(response.data.success){
            this.username = response.data.data.username;
            this.email = response.data.data.email;
            if (response.data.data.bio !== null){
              this.bio = response.data.data.bio;
            }
            this.setIsModified(false);
          }
        })
        .catch(error => {
          console.error('Error fetching profile details:', error);
        });
      //this.avatarUrl = response.data.avatarUrl;
    },
    handleAvatarChange(event) {
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append('avatar', file);
      // Send the file to the server and update the image in the database
      const reader = new FileReader();
      reader.onload = () => {
        this.avatarUrl = reader.result;
      };
      reader.readAsDataURL(file);
    }
  }
};
</script>
