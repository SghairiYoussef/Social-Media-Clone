<template>
    <header>
        <p>
            Welcome To INSAT Social Club!
        </p>
        <img src="..\..\public\img\logo.gif" alt="INSAT Social Club Logo" style="width:50px;" class="rounded-pill">
    </header>
    <hr>
    <div class="row">
        <p class="Intro">
            Welcome to INSAT Social Club! We are a group of students from INSAT who have created this platform to connect with other students and share our experiences.
        </p>
        <p class="col-sm-4">
            INSAT Social Club is a platform for students to share their thoughts, ideas, and experiences with each other.
        </p>
        <p class="col-sm-4">
            You can create posts, react to posts, comment on posts, and share posts with your friends.
        </p>
        <p class="col-sm-4">
            You can also view other students' profiles and follow them to see their posts in your feed.
        </p>
    </div>
    <hr>
    <div class="Team row">
        <p>
            Meet the team behind INSAT Social Club:
        </p>
        <div class="member" v-for="(member,index) in members" :key="index">
            <img :src="member.image" alt="Team Member" class="rounded-pill" style="width: 200px">
            <p class="member-name">{{ member.name }}</p>
            <p class="member-quote">{{ member.quote }}</p>
            <hr>
        </div>
    </div>
    <div class="Contact">
        <div class="row-contact">
            <p>
                If you have any questions or feedback, please feel free to contact us.
            </p>
            <button @click="contact()" class="btn btn-info">
            Contact Us
            </button>
        </div>
    </div>
    <button @click="login()" type="button" class="btn btn-warning" style="position: fixed; bottom: 20px; right: 20px; z-index: 999;">
        login
    </button>
</template>

<script>
export default {
    data() {
        return {
            members: [
                {
                    name: 'Youssef Sghairi',
                    image: '../../public/img/sghairi.jpeg',
                    quote: 'The only way to do great work is to love what you do.'
                },
                {
                    name: 'Mohamed Yessine Tayeb',
                    image: '../../public/img/yessine.png',
                    quote: 'Success is not the key to happiness. Happiness is the key to success.'
                },
                {
                    name: 'Mohamed Amine Haouas',
                    image: '../../public/img/amine.jpg',
                    quote: 'The only limit to our realization of tomorrow will be our doubts of today.'
                },
                {
                    name: 'Youssef Aridhi',
                    image: '../../public/img/aridhi.jpg',
                    quote: 'The only way to achieve the impossible is to believe it is possible.'
                },
                {
                    name: 'Kacem Mathlouthi',
                    image: '../../public/img/kacem.png',
                    quote: 'Haja tefha khater Kacem tefah'
                }
            ]
        }
    },
    methods: {
        login() {
            this.$router.push({ name: 'SigninSignup' });
        },
        contact() {
            this.$router.push({ name: 'Contact' });
        }
    },
    name: 'AboutUs'
}
</script>


<style scoped>
    header {
        background-color: #160C28;
        color: white;
        text-align: center;
        padding: 10px;
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
        padding: 20px;
    }

    .col-sm-4 {
        width: 30%;
        text-align: center;
        background-color: #F2E9E4;
        padding: 10px;
        border-radius: 10px;
        margin-right: 10px;
    }
    .Intro {
        text-align: center;
        margin-bottom: 20px;
    }
    .Team {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
        padding: 20px;
    }

    .member {
        margin: 10px;
        text-align: center;
        width: 100%;
    }
    .member-name {
        font-weight: bold;
    }
    .member-quote {
        font-style: italic;
    }
    .Contact {
        text-align: center;
        margin-bottom: 20px;
    }
    .btn-info {
        background-color: #160C28;
        color: white;
    }
</style>