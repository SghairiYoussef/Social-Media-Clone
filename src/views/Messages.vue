<template>
    <navBar/>
    <header>
        <h1>Messages</h1>
        <h2>{{ selectedUser?.username }}</h2>
        <p>{{ status }}</p> <!-- Display user status (online wala le) here  -->
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
            users: [],
            status: 'Online'
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
            console.log(this.users);
        },
        selectUser(user) {
            this.selectedUser = user;
        }
    }
};
</script>

<style>
    .userBox
    {
        background-color: white;
        display: flex;
        margin-bottom: 10px;
        align-items: center;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
