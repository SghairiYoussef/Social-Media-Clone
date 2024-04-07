<template>
  <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Inbox
    </li>
    <li class="input-group mb-3">
      <searchBar :users="users"/>
    </li>
    <li v-for="(user, index) in users" :key="index" @click="selectUser(user)" @dblclick="redirectToProfile(user)">
      <div class="userBox">
        <img :src="user.avatar" alt="User Image" class="rounded-pill" style="width: 40px;">
        {{ user.username }}
        <div class="userStatus" :class="{ 'text-success': user.userStatus === 'Online', 'text-danger': user.userStatus === 'Offline' }">
          {{ user.userStatus }}
        </div>
      </div>
    </li>
  </ul>
</template>

<script>
import axios from "axios";
import searchBar from '@/components/searchBar.vue';

export default {
  mounted() {
    this.fetchUsers();
    this.fetchInterval = setInterval(() => {
      this.fetchUsers();
    }, 500);
  },
  beforeUnmount() {
    clearInterval(this.fetchInterval);
  },
  data() {
    return {
      search: '',
      users: []
    }
  },
  methods: {
    selectUser(user) {
      this.$emit('user-selected', user);
      if (this.$route.path === '/Home') {
        this.$router.push('/Messages');
      }
    },
    redirectToProfile(user) {
      this.$router.push(`/profile?User_ID=${user.userID}`);
    },
    fetchUsers() {
      function transformUserData(user) {
                    return {
                    
                        userID: user.userID,
                        username: user.username,
                        avatar: user.img? require(`../../back/avatars/${user.img}`) : require(`../../../public/img/noProfileImage.jpg`),
                        userStatus: user.userStatus
                    
                    };
                }
      const sessionId = sessionStorage.getItem('sessionId');
      let data = new FormData();
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/messengerApi.php?action=getUsers', data)
          .then(response => {
            let result = response.data;
            result = result.map(user=>transformUserData(user));
            this.users = result;
            this.$emit('users-fetched', response.data);
          })
          .catch(error => {
            console.error('Error fetching users:', error);
          });
    }
  },
  name: 'InBox',
  components: {
    searchBar
  }
}
</script>

<style scoped>
.list-group {
  padding: 0;
  margin: 0;
  list-style: none;
}

.list-group-item {
  background-color: #f8f9fa;
  border: none;
  border-radius: 10px;
  margin-bottom: 10px;
  cursor: pointer;
}

.list-group-item:hover {
  background-color: #e9ecef;
}

.userBox {
  display: flex;
  align-items: center;
  padding: 10px;
  background-color: #fff;
  border-radius: 10px;
  cursor: pointer;
}

.userBox img {
  margin-right: 10px;
  border-radius: 50%;
}

.userBox:hover {
  background-color: #f1f1f1;
}

.input-group {
  width: 100%;
}

.input-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ced4da;
  border-radius: 5px;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.input-group input:focus {
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
}
.userStatus {
  margin-left: 20px;
}
</style>
