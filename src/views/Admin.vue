<template>
    <div>
        <h1>Admin Dashboard</h1>
    </div>
    <div v-if="!authenticated" class="alert alert-danger">
        <p>You are not authenticated, <strong>You need to be an admin to enter.</strong></p>
    </div>
    <div v-else class="row">
        <div  class="col-sm-3">
            <div class="container-1">
                <admin-side-bar @users="users()" @posts="posts" @reports="reports"/>
            </div>
        </div>
        <div class="col-sm-9">
            <userSection v-if="active=='users'"/>
            <reports v-else-if="active=='reports'"/>
            <posts v-else-if="active=='posts'"/>
        </div>
    </div>
</template>

<script>
import adminSideBar from '@/components/Admin/admin-side-bar.vue'
import userSection from '@/components/Admin/user-section.vue'
import reports from '@/components/Admin/reports.vue'
import posts from '@/components/Admin/posts.vue'

export default {
    data() {
        return {
            authenticated: true,
            active: 'users'
        }
    },
    components: {
        adminSideBar,
        userSection,
        reports,
        posts
    },
    /*props: {
        authenticated: {
            type: Boolean,
            required: true
        },
    },*/
    name: 'Admin-Page',
    methods: {
        users() {
            this.active = 'users';
        },
        posts() {
            this.active = 'posts';
        },
        reports() {
            this.active = 'reports';
        }
    }
}
</script>

<style scoped>

    h1 {
        margin-top: 20px;
        margin-left: 40px;
        margin-right: 40px;
        background-color: #7180AC;
        color: black;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    col-sm-9 {
        margin-left: 40px;
        margin-right: 40px;
    }

    .container-1 {
        margin-left: 40px;
        margin-right: 40px;
        background-color: #7180AC;
        color: black;
        padding: 20px;
        border-radius: 10px;
        height: 100%;
    }
</style>