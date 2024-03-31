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
            <Chat :Receiver="selectedUser"/>
        </div>
    </div>
</template>

<script>
import Chat from '@/components/MessageBox/Chat.vue';
import navBar from '@/components/navbar.vue';
import Inbox from '@/components/MessageBox/Inbox.vue';

export default {
    name: 'MessageBox',
    components: {
        Chat,
        navBar,
        Inbox
    },

    data()
    {
        return{
            status: 'Online',
            search: '',
            users: [],
            selectedUser: null
        }
    },

    methods: {
        selectUser(user)
        {
            this.selectedUser = user;
            console.log(this.selectedUser);
        },
        setUsers(users) {
            this.users = users;
            console.log(this.users);
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
