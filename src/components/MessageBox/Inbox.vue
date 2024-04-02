<template>
  <ul class="list-group">
    <li class="list-group-item d-flex justify-content-between align-items-center">
      Inbox
      <!--<span class="badge bg-primary rounded-pill">{{ total_unread_messages() }}</span>-->
    </li>
    <li class="input-group mb-3">
      <searchBar :users="users"/>
    </li>
    <li v-for="(user, index) in users" :key="index" @click="selectUser(user)">
      <div class="userBox">
        <img :src="user.img ? require(`../../back/avatars/${user.img}`) : require(`../../../public/img/noProfileImage.jpg`)" alt="User Image" class="rounded-pill user-avatar">
        <span class="username">{{ user.username }}</span>
        <!--<span class="badge bg-danger">{{user.unread_messages}}</span>-->
      </div>
    </li>
  </ul>
</template>

<script>
import axios from "axios";
import searchBar from '@/components/searchBar.vue';
import router from "@/router"; // Import Vue Router instance

export default {
  mounted() {
    this.fetchUsers();
  },
  data() {
    return {
      search: '',
      users: []
    }
  },
  methods: {
    selectUser(user) {
      // Redirect to Messages route with user ID as parameter
      router.push({ name: 'Messages', params: { userId: user.id } });
    },
    fetchUsers() {
      const sessionId = sessionStorage.getItem('sessionId');
      let data = new FormData();
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/messengerApi.php?action=getUsers', data)
          .then(response => {
            console.log(response.data);
            this.users = response.data;
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

.user-avatar {
  margin-right: 10px;
  border-radius: 50%;
  width: 40px; /* Setting a fixed width for consistency */
}

.username {
  font-size: 16px; /* Adjusting font size for better readability */
  color: #333; /* Darkening text color */
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
</style>
