<template>
  <div class="card h-100">
    <div class="card-body">
      <div class="account-settings">
        <div class="user-profile">
          <div class="user-avatar">
            <img :src="avatarUrl" alt="ProfileImage" class="ProfileImage img-fluid rounded-circle">
            <label for="avatarUpload" class="btn btn-outline-danger mt-2">Upload Image</label>
            <input ref="avatarInput" type="file" id="avatarUpload" name="file" accept="image/*" @change="handleAvatarChange" style="display: none;">
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
      //this.avatarUrl = require('path/' + response.data.avatarUrl);
    },
    handleAvatarChange() {
      let fileInput = this.$refs.avatarInput;
      let file = fileInput.files[0];
      console.log(file);
      if (!file) {
        console.error('No file selected.');
        return;
      } else if (file.size > 2097152) {
        console.error('File size exceeds 2MB.');
        return;
      } else if (!file.type.startsWith('image/')) {
        console.error('File is not an image.');
        return;
      } else if (!['.jpg', '.jpeg', '.png', '.gif'].includes(file.name.slice(-4).toLowerCase())) {
        console.error('File is not a valid image format.');
        return;
      }
      let sessionId = sessionStorage.getItem('sessionId');
      const data = new FormData();
      data.append('avatar', file);
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/EditProfileAPI.php?action=UploadAvatar', data)
        .then(response => {
          console.log(response.data);
          if (response.data.success) {
            console.log('Avatar uploaded:', response.data.message);
            this.avatarUrl = require('../../back/' + response.data.path);     
          }
        })
        .catch(error => {
          console.error('Avatar upload error:', error);
        });
    }
  }
};
</script>
