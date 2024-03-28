<template>
    <navBar/>
    <header>
        <h1>Messages</h1>
        <h2>{{ Name }}</h2>
        <p>{{ status }}</p> <!-- Display user status (online wala le) here  -->
    </header>
    <div class="row">
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Inbox
                    <span class="badge bg-primary rounded-pill">{{ total_unread_messages() }}</span>
                </li>
                <li class="input-group mb-3">
                    <input type="text" v-model="search" placeholder="Search users..." class="form-control">
                    <button class="btn btn-success" type="submit">Go</button>
                </li>
                <li v-for="user in users" :key="user.id" @click="selectUser(user)">
                    <div class="userBox">
                        <img src="https://via.placeholder.com/150" alt="User Image" class="rounded-pill" style="width: 40px;">
                        {{ user.name }}
                        <span class="badge bg-danger">{{user.unread_messages}}</span>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="activeContactIndex === null" class="Note">
            Select a contact to start chatting
        </div>
        <div v-else class="col-sm-8">
            <Chat :Receiver="users[activeContactIndex]"/>
        </div>
    </div>
</template>

<script>
import Chat from '@/components/MessageBox/Chat.vue';
import navBar from '@/components/navbar.vue';

export default {
    name: 'MessageBox',
    components: {
        Chat,
        navBar
    },

    data()
    {
        return{
            status: 'Online',
            search: '',
            users: [
                {
                    id: 1,
                    name: 'User 1',
                    unread_messages: 2
                },
                {
                    id: 2,
                    name: 'User 2',
                    unread_messages: 0
                },
                {
                    id: 3,
                    name: 'User 3',
                    unread_messages: 1
                }
            ],
            activeContactIndex: null
        }
    },

    methods: {
        selectUser(user)
        {
            this.activeContactIndex = this.users.indexOf(user);
        },
        total_unread_messages()
        {
            let total = 0;
            for(let i = 0; i < this.users.length; i++)
            {
                total += this.users[i].unread_messages;
            }
            return total;
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

    .user_img
    {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }
</style>
