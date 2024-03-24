<template>
    <nav class="menu-container">
        <input type="checkbox" id="toggle-menu" aria-label="Toggle menu" />
        <label for="toggle-menu">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <a href="#" class="menu-logo">
            <img src="https://wweb.dev/resources/navigation-generator/logo-placeholder.png" alt="Buzz"/>
        </a>

        <div class="menu">
            <ul>
                <li>
                    <div class="custom_input">
                        <input class="search" type="text" placeholder="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg_icon bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path></svg>
                    </div>
                </li>
                <li>
                    <a href="/home" rel="noopener noreferrer">Home</a>
                </li>
                <li>
                    <a href="/messages" rel="noopener noreferrer">Messages</a>
                </li>
                <li>
                    <a href="/myaccount" rel="noopener noreferrer">My Account</a>
                </li>
                <li>
                    <a href="/contact" rel="noopener noreferrer">Contact Us</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/" target="_blank" rel="noopener noreferrer">Sign Out</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'Navbar'
    }
</script>