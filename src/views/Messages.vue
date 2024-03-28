<template>
    <navBar/>
    <header>
        <h1>Messages</h1>
        <h2>{{ Name }}</h2>
        <p>{{ status }}</p> <!-- Display user status (online wala le) here  -->
    </header>
    <div class="row">
        <div class="col-sm-4">
            <Inbox :users="users" @user-selected="selectUser"/>
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
