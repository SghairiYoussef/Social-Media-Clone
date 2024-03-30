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
                <tr v-if = "users.length === 0">
                    <td colspan="4" class="Note">No users found</td>
                </tr>
                <tr v-else v-for="user in users" :key="user.User_ID">
                    <td>{{ user.Username }}</td>
                    <td>{{ user.Email }}</td>
                    <td>{{ user.Role }}</td>
                    <td>
                        <button @click="editUser(user)" class="btn btn-primary">Edit</button>
                        <button @click="deleteUser(user)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="Chart col-sm-6">
            <chartSection/>
        </div>
        <div class="Chart-Container col-sm-5">
            <img src="../../../public/img/logo.gif" alt="Logo" style="width:400px;" class="rounded-pill">
        </div>
    </div>
</template>

<script>
    import chartSection from '@/components/Admin/chartSection.vue'

    export default {
        data() {
            return {
                users:[]
            }
        },
        methods: {
            editUser(user) {
                console.log('Edit user', user);
            },
            deleteUser(user) {
                console.log('Delete user', user);
            }
        },
        /*mounted() {
            fetch('http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=getUsers')
                .then(response => response.json())
                .then(data => {
                    this.users = data;
                });
        },*/
        components: {
            chartSection
        }
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
</style>