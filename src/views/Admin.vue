<template>
    <div>
      <sidebar-menu :menu="menu" @update:collapsed="onToggleCollapse" @item-click="onItemClick" />
      <div class="content" :style="{ 'margin-left': isSidebarCollapsed ? '70px' : '300px' }">
        <component :is="activeComponent" />
      </div>
    </div>
  </template>
  
  <script>
  import { SidebarMenu } from 'vue-sidebar-menu'
  import 'vue-sidebar-menu/dist/vue-sidebar-menu.css'
  import userSection from '@/components/Admin/user-section.vue'
  import reports from '@/components/Admin/reports.vue'
  import posts from '@/components/Admin/posts.vue'
  import axios from 'axios'
  
  export default {
    components: {
      SidebarMenu,
      userSection,
      reports,
      posts
    },
    name: 'AdminPage',
    data() {
      return {
        menu: [
            {
                header: 'Main Navigation',
                hiddenOnCollapse: true
            },
            {
                title: 'Users',
                icon: 'fa fa-user'
            },
            {
                title: 'Posts',
                icon: 'fa fa-chart-area'
            },
            {
                title: 'Reports',
                icon: 'fa fa-table'
            },
            {
                header: 'Settings',
                hiddenOnCollapse: true
            },
            {
                title: 'Home Page',
                icon: 'fa fa-home'
            },
            {
                title: 'Logout',
                icon: 'fa fa-sign-out-alt'
            }
        ],
        isSidebarCollapsed: false,
        activeComponent: userSection // Default active component
      }
    },
    methods: {
      onItemClick(event,item) {
        switch (item.title.toLowerCase()) {
            case 'users':
                this.activeComponent = userSection;
                break;
            case 'posts':
                this.activeComponent = posts;
                break;
            case 'reports':
                this.activeComponent = reports;
                break;
                case 'home page':
                this.$router.push('/Home');
                break;
            case 'logout':
                this.logout();
                break;
            default:
                break;
        }
      },
      onToggleCollapse(collapsed) {
        this.isSidebarCollapsed = collapsed;
      },
        logout() {
            const sessionID = sessionStorage.getItem('sessionId');
            let data =new FormData();
            data.append('sessionID', sessionID);
            axios.defaults.withCredentials = true;
            axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=logout`,data)
            .then(response => {
            console.log(response.data.message);
            if(response.data.success) {
                sessionStorage.removeItem('sessionId');
                sessionStorage.removeItem('userId');
                this.$router.push('/login');
            }
            })
            .catch(error => {
            console.log(error);
            });
        }
    }
  }
  </script>
  
  <style>
  .content {
    padding: 20px;
    transition: margin-left 0.3s ease;
  }
  </style>
  