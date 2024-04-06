<template>
  <div class="card h-100">
    <div class="card-body">
      <div class="account-settings">
        <div class="user-profile">
          <div class="user-avatar">
            <img :src="avatarUrl" alt="ProfileImage" class="ProfileImage img-fluid rounded-circle">
            <label v-if="showUploadButton" for="avatarUpload" class="btn btn-outline-danger mt-2">Upload Image</label>
            <input v-if="showUploadButton" type="file" id="avatarUpload" name="file" accept="image/*" @change="handleAvatarChange" style="display: none;">
          </div>
          <h5 class="username">{{ username }}</h5>
          <h6 v-if="showUploadButton" class="user-email"><a :href="'mailto:' + email">{{ email }}</a></h6>
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
  props: {
    showUploadButton: {
      type: Boolean,
      required: true
    }
  },
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
    isModified: {
      immediate: true,
      handler(newValue, oldValue) {
        if (newValue!==oldValue) {
          this.fetchUserData();
        }
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
          if(response.data.success){
            this.username = response.data.data.username;
            this.email = response.data.data.email;
            if (response.data.data.bio !== null){
              this.bio = response.data.data.bio;
            }
            if (response.data.data.img !== null){
              this.avatarUrl = require('../../back/avatars/' + response.data.data.img);
            }
            this.setIsModified(false);
          }
        })
        .catch(error => {
          console.error('Error fetching profile details:', error);
        });
    },
    handleAvatarChange() {
      let fileInput = document.querySelector('input[type="file"]');
      let file = fileInput.files[0];
      if (!file) {
        return;
      }
      else if (file.size > 2097152) {
        alert('File size must be less than 2MB');
        return;
      }
      else if (!file.type.match('image.*')) {
        alert('File must be an image');
        return;
      }
      else if (file.type !== 'image/jpeg' && file.type !== 'image/png' && file.type !== 'image/jpg') {
        alert('File must be a JPEG, JPG, or PNG');
        return;
      }
      let sessionId = sessionStorage.getItem('sessionId');
      const data = new FormData();
      data.append('avatar', file);
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/EditProfileAPI.php?action=UploadAvatar', data)
        .then(response => {
          if (response.data.success) {
            console.log(response.data.message);
            this.avatarUrl = require('../../back/avatars/' + response.data.path);
          }
        })
        .catch(error => {
          console.error('Avatar upload error:', error);
        });
    }
  }
};
</script>
