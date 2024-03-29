<template>
    <div>
        <h1>Admin Dashboard</h1>
    </div>
    <div v-if="!authenticated" class="alert alert-danger">
        <p>You are not authenticated, <strong>You need to be an admin to enter.</strong></p>
    </div>
    <div v-else class="row">
        <div  class="col-sm-3">
            <admin-side-bar/>
        </div>
        <div class="col-sm-9">
            <userSection/>
        </div>
    </div>
</template>

<script>
import adminSideBar from '@/components/Admin/admin-side-bar.vue'
import userSection from '@/components/Admin/user-section.vue'

export default {
    data() {
        return {
            authenticated: true
        }
    },
    components: {
        adminSideBar,
        userSection
    },
    /*props: {
        authenticated: {
            type: Boolean,
            required: true
        },
    },*/
    name: 'Admin-Page',
}
</script>

<style scoped>

    h1 {
        margin-top: 20px;
        margin-left: 40px;
        margin-right: 40px;
        background-color: #4a4e69;
        color: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }
    col-sm-9 {
        margin-left: 40px;
        margin-right: 40px;
    }
</style>