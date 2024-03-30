<template>
    <nav class="navbar navbar-expand-sm navbar-custom navbar-dark justify-content-center">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/img/logo.jpg" alt="Logo" style="width:50px;" class="rounded-pill">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/Home" style="font-size: 20px" >Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Messages" style="font-size: 20px">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/MyAccount" style="font-size: 20px">My Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact" style="font-size: 20px">Contact Us</a>
                </li>
            </ul>
        </div>
        <form class="d-flex">
            <input class="form-control me-2" type="text" placeholder="Search">
            <button class="btn btn-secondary" type="button">Search</button>
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

    export default {
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

<style scoped>
    .navbar-custom {
        background-color: #22223b;
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