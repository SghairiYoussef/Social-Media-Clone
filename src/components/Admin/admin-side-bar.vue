<template>
    <div class="nav flex-column">
            <h2>Control Panel</h2>
            <button @click="users()" class="btn btn-outline-dark">Users</button>
            <button @click="posts()" class="btn btn-outline-dark">Posts</button>
            <button @click="reports()" class="btn btn-outline-dark">Reports</button>
            <router-link to="/Home" class="btn btn-outline-dark">Home Page</router-link>
        </div>
</template>

<script>
    export default {
        name: 'AdminSideBar',
        methods: {
            users() {
                this.$emit('users');
            },
            posts() {
                this.$emit('posts');
            },
            reports() {
                this.$emit('reports');
            }
        }
    }
</script>
<style scoped>
    
    .nav {
        margin-right: 0px;
        background-color: #7180AC;
        padding: 20px;
        border-radius: 10px;
        height: 100%;
    }
    .nav h2 {
        margin-bottom: 20px;
    }
    .btn {
        margin-bottom: 10px;
    }
</style>