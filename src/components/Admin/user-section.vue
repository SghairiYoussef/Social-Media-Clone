<template>
    <div class="table-container">
        <table class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="users.length === 0">
                    <td colspan="4" class="Note">No users found</td>
                </tr>
                <tr v-for="user in displayedUsers()" :key="user.User_ID">
                    <td>{{ user.Username }}</td>
                    <td>{{ user.Email }}</td>
                    <td>{{ user.Role }}</td>
                    <td>
                        
                        <button @click="deleteUser(user.User_ID)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr v-if="showMoreButton()">
                    <td colspan="4">
                        <button @click="loadMoreUsers()" class="btn btn-primary">Show More</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                users:[],
                displayedUsersCount: 5,
            }
        },
        methods: {
            deleteUser(User_ID) {
                let data = new FormData();
                data.append('User_ID',User_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=deleteUser`,data)
            .then(response => {
                console.log(response,"user deleted");
                this.fetchUsers();
            })
            .catch(error => {
                console.error('Error deleting user:', error);
      });
            },
            loadMoreUsers() {
                this.displayedUsersCount += 4;
            },
            displayedUsers() {
                return this.users.slice(0, this.displayedUsersCount);
            },
            showMoreButton() {
                return this.displayedUsersCount < this.users.length;
            },
            fetchUsers(){
                function transformData(user) {
                    return {
                        User_ID : user.userID,
                        Username: user.userName,
                        Email: user.email,
                        Role: "User"
                    };
                }
            axios.get(`http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=getAllUsers`)
            .then(response => {
                
                let result = response.data;
                result = result.map(user=>transformData(user));
                console.log("users");
                console.log(result);
                this.users = result;
                
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
            }
        },
        mounted() {
            this.fetchUsers();
        },
    }
</script>

<style scoped>
    .table {
        width: 90%;
        margin: 20px auto;
        margin-top:10px auto ;
    }
    .table-container {
        margin-right: 40px;
        background-color: #9a8c98;
        color: white;
        padding: 20px;
        border-radius: 20px;
    }
    .Chart {
        margin-right: 40px;
        margin-left: 20px;
        background-color: white;
        padding: 20px;
        border-radius: 20px;
        margin-top: 20px;
    }
    .Chart-Container {
        background-color: #f2e9e4;
        padding: 20px;
        border-radius: 20px;
        margin-top: 20px;
        align-items: center;
    }
    .rounded-pill {
        margin-left: 20px;
    }
</style>