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
    <div class="Chart">
        <chartSection/>
    </div>
</template>

<script>
    import chartSection from '@/components/Admin/chartSection.vue'

    export default {
        data() {
            return {
                users: [
                    {
                        User_ID: 1,
                        Username: 'John Doe',
                        Email: 'Doe@example.com',
                        Role: 'Admin'
                    },
                ]
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
    .table-container {
        margin-right: 40px;
    }
</style>