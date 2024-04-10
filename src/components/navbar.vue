<template>
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark justify-content-center">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/img/navlogo.gif" alt="Logo" style="width:100px;" >
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" @click="redirectHome" style="font-size: 20px" >Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="redirectMessages" style="font-size: 20px">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="redirectMyAccount" style="font-size: 20px">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" @click="redirectContactUs" style="font-size: 20px">Contact Us</a>
                </li>
                <li class="nav-item" v-if="isAdmin">
                    <a class="nav-link" @click="redirectAdmin" style="font-size: 20px">Admin Panel</a>
                </li>
            </ul>
        </div>
        <form class="d-flex">
            <searchBar :users="users"/>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" style="font-size: 20px" @click="logout">Logout</a>
          </li>
        </ul>
    </div>
    </nav>
</template>

<script>
import axios from "axios";
import searchBar from '@/components/searchBar.vue';


    export default {
        data () {
            return {
                users: [],
                isAdmin: false
            }
        },
        name: 'NavBar',
        methods: {
            logout() {
              const sessionID = sessionStorage.getItem('sessionId');
              let data =new FormData();
              data.append('sessionID', sessionID);
              axios.defaults.withCredentials = true;
              axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=logout`,data)
              .then(response => {
                console.log(response.data);
                if(response.data.success) {
                  console.log(response.data.message);
                  sessionStorage.removeItem('sessionId');
                  sessionStorage.removeItem('userId');
                  this.$router.push('/login');
                }
              })
              .catch(error => {
                console.log(error);
              });


            },
            redirectHome() {
                this.$router.push('/Home');
            },
            redirectAdmin() {
                this.$router.push('/Admin');
            },
            redirectMessages() {
                this.$router.push('/Messages');
            },
            redirectMyAccount() {
                this.$router.push('/myAccount');
            },
            redirectContactUs() {
                this.$router.push('/Contact');
            },
            fetchUsersInfo(){
            function transformUserData(user) {
                    return {
                    
                        userID: user.userID,
                        name : user.fullName,
                        username: user.userName,
                        email: user.email,
                        avatar: user.img? require(`../back/avatars/${user.img}`) : require(`../../public/img/noProfileImage.jpg`),
                        bio: user.bio,
                    
                    };
                }
                axios.get(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getAllUsers`)
                .then(response => {
                    let result = response.data;
                    result = result.map(user=>transformUserData(user));
                    this.users = result;
                })
                .catch(error => {
                    console.error('Error fetching User info:', error);
        });
            }
        },
        components: {
            searchBar
        },
        created () {
            this.fetchUsersInfo();
        },
        mounted() {
            let data = new FormData();
            let sessionId = sessionStorage.getItem('sessionId');
            data.append('sessionId', sessionId);
            axios.post('http://localhost/php/Social-Media-Clone/src/back/api.php?action=verifyAdmin', data)
            .then(response => {
                if(response.data.success){
                    if(response.data.isAdmin){
                        this.isAdmin = true;
                    }
                    else{
                        this.isAdmin = false;
                    }
          }
        })
        .catch(error => {
          console.error('Error fetching profile details:', error);
        });
        }
    }

</script>

<style scoped>
    .navbar-custom {
        background-color: #0D161A;
        color: white;
    }
    .navbar-brand {
        margin-right: 20px;
    }
    .nav-link {
        margin-right: 20px;
        cursor: pointer;
    }
    .form-control {
        margin-right: 20px;
    }
    .btn {
        margin-right: 20px;
    }
</style>