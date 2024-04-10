<template>
    <navBar/>
    <header>
        <h1>Messages</h1>
        <h2>{{ selectedUser?.username }}</h2>   
    </header>
    <div class="row">
        <div class="col-sm-4">
            <Inbox @users-fetched="setUsers" @user-selected="selectUser"/>
        </div>
        <div v-if="!selectedUser" class="Note">
            Select a contact to start chatting
        </div>
        <div v-else class="col-sm-8">
            <OnlineChat :selectedUser="selectedUser"/>
        </div>
    </div>
</template>

<script>
import OnlineChat from '@/components/MessageBox/OnlineChat.vue';
import navBar from '@/components/navbar.vue';
import Inbox from '@/components/MessageBox/Inbox.vue';

export default {
    data() {
        return {
            selectedUser: null,
            users: []
        };
    },
    name: 'MessageBox',
    components: {
        OnlineChat,
        navBar,
        Inbox
    },
    methods: {
        setUsers(users) {
            this.users = users;
        },
        selectUser(user) {
            this.selectedUser = user;
        }
    }
};
</script>

<style scoped>
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
}

header {
  padding: 20px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #dee2e6;
  text-align: center;
}

h1 {
  margin-bottom: 5px;
  font-size: 24px;
}

h2 {
  margin-bottom: 10px;
  font-size: 20px;
}

p {
  margin-bottom: 0;
  color: #6c757d;
}

.row {
  margin-top: 20px;
}

.Note {
  padding: 20px;
  text-align: center;
  color: #6c757d;
}

.col-sm-4,
.col-sm-8 {
  padding: 0 15px;
}

.userBox {
  background-color: #fff;
  display: flex;
  margin-bottom: 10px;
  align-items: center;
  cursor: pointer;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
  transition: box-shadow 0.3s ease;
}

.userBox img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.userBox:hover {
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

</style>