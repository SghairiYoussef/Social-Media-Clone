<template>
  <div class="card h-100">
    <div class="card-body">
      <div class="account-settings">
        <div class="user-profile">
          <div class="user-avatar">
            <img :src="avatarUrl" alt="ProfileImage" class="ProfileImage">
            <input type="file" accept="image/*" @change="handleAvatarChange">
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
export default {
  data() {
    return {
      username: '',
      email: '',
      bio: '',
      avatarUrl: require('../../../public/img/noProfileImage.jpg')
    };
  },
  mounted() {
    this.fetchUserData();
  },
  methods: {
    fetchUserData() {
      // Fetch user data from the database
      this.username = 'Username';
      this.email = 'example@email.com';
      this.bio = 'This place is reserved for bio description.';
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
