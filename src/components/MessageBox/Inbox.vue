<template>
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
</template>

<script>
    export default {
        data() {
            return {
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
            total_unread_messages() {
                let total = 0;
                    for(let i = 0; i < this.users.length; i++)
                    {
                        total += this.users[i].unread_messages;
                    }
                    return total;
            },
            selectUser(user) {
                this.$emit('user-selected', user);
            }
        },
        name: 'InBox',
    }
</script>