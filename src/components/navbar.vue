<template>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="../../public/img/logo.jpg" alt="Logo" style="width:80px;" class="rounded-pill">
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
    </div>
    </nav>
</template>

<script>
    export default {
        name: 'NavBar',
        SignedIn: false
    }
</script>