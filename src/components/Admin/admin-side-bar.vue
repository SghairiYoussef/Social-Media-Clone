<template>
    <div class="nav flex-column">
            <h2>Control Panel</h2>
            <router-link to="/admin/users" class="btn btn-outline-secondary">Users</router-link>
            <router-link to="/admin/posts" class="btn btn-outline-secondary">Posts</router-link>
            <router-link to="/admin/reports" class="btn btn-outline-secondary">Reports</router-link>
            <router-link to="/Home" class="btn btn-outline-secondary">Home Page</router-link>
        </div>
</template>

<style scoped>
    
    .nav {
        margin-left: 40px;
        margin-right: 0px;
        background-color: #22223b;
        color: white;
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