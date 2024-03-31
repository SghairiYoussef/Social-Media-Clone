<template>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Inbox
            <!--<span class="badge bg-primary rounded-pill">{{ total_unread_messages() }}</span>-->
        </li>
        <li class="input-group mb-3">
            <input type="text" v-model="search" placeholder="Search users..." class="form-control">
            <button class="btn btn-success" type="submit">Go</button>
        </li>
      <li v-for="(user, index) in users" :key="index" @click="selectUser(user)">
        <div class="userBox">
        <img src="../../../public/img/noProfileImage.jpg" alt="User Image" class="rounded-pill" style="width: 40px;">
        <!--<img :src="user.avatar" alt="User Image" class="rounded-pill" style="width: 40px;">-->
                {{ user.username }}
                <!--<span class="badge bg-danger">{{user.unread_messages}}</span>-->
            </div>
        </li>
    </ul>
</template>

<script>
    import axios from "axios";
    export default {
      mounted() {
            this.fetchUsers();
      },
      data() {
            return {
                search: '',
                users: []            }
        },
        methods: {
            selectUser(user) {
                this.$emit('user-selected', user);
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
    }
</script>