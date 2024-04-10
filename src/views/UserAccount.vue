<template>
    <navBar class="Fixed-navbar" />
    <header class="main-header">
        <img :src="user.background" alt="User Background" class="background">
        <div class="header-content">
            <div class="avatar-container">
                <img :src="user.avatar" alt="User Avatar" class="avatar">
            </div>
            <div class="user-info">
                <h1 class="profileUsername">{{ user.username }}</h1>
                <h2 class="profileName">{{ user.name }}</h2>
                <p class="bio">{{ user.bio }}</p>
            </div>
        </div>
    </header>
    <div v-if="Posts.length > 0">
        <PostSection  :Posts="visiblePosts" @postAdded="handlePostAdded()" @postDeleted="handlePostDeleted()" /> <!-- Fixed The Visible Posts problem -->
        <button class="btn btn-info"  @click="loadMorePosts()">Load More</button>
    </div>
    <div v-else>
        <p class="Note">No more posts to load</p>
    </div>
</template>

<script>
import PostSection from '@/components/HomePage/PostSection.vue';
import navBar from '@/components/navbar.vue';
import axios from 'axios';

export default {
    data() {
        return {
            user: {},
            Posts: [],
            visiblePostCount: 8,
        };
    },
    components: {
        PostSection,
        navBar
    },
    computed: {
        visiblePosts() {
            return this.Posts.slice(0, this.visiblePostCount);
        },
        hasMorePosts() {
            return this.visiblePostCount < this.Posts.length;
        },
    },
    methods: {
        // Method to load more posts
        loadMorePosts() {
            // Increase the number of visible posts
            this.visiblePostCount += 5; // You can adjust the number as needed
        },
        // Method to fetch posts from an API or other data source
        fetchPosts() {
            function transformPost(post) {
                    return {
                        user: {
                            id:post.userID,
                            name: post.userName,
                            img: post.img ? require('../back/avatars/' + post.img) : require('../../public/img/noProfileImage.jpg'),
                            alt: 'User Image'
                        },
                        content: post.Caption,
                        img: post.Media ?require('../back/uploads/' + post.Media) : "",
                        alt: 'Post Image',
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked: post.isLiked,
                        Post_ID : post.Post_ID,
                        React_Count : post.React_Count,
                      date: post.Date_published

                    };
                }
            let data =new FormData();
            data.append('userID',this.getParameterByName('User_ID'));
            const sessionId = sessionStorage.getItem('sessionId');
            if (sessionId !== null) {
                data.append('sessionId', sessionId);
            }
            axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getUserPosts`,data)
            .then(response => {
                
                let result = response.data;
                console.log(result);
                result = result.map(post=>transformPost(post))
                this.Posts = result;
                console.log(this.Posts);
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
        },
        fetchUserInfo(){
            function transformUserData(user) {
                    return {
                    
                        id: user.userID,
                        name : user.fullName,
                        username: user.userName,
                        email: user.email,
                        avatar: user.img? require(`../back/avatars/${user.img}`) : require(`../../public/img/noProfileImage.jpg`),
                        background: user.background? user.background : 'https://wweb.dev/resources/navigation-generator/logo-placeholder-background.png',
                        bio: user.bio,            
                    };
                }
                let data =new FormData();
                data.append('userID',this.getParameterByName('User_ID'));
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getUserProfile`,data)
                .then(response => {
                    
                    let result = response.data;
                    console.log(result);
                    result = transformUserData(result);
                    this.user = result;
                    console.log(this.user);
                })
                .catch(error => {
                    console.error('Error fetching User info:', error);
        });
        },
        handlePostAdded() {
            this.fetchPosts();
        },
        editProfile(){
            this.$router.push('/EditProfile');
        },
        handlePostDeleted(){
            this.fetchPosts();
        },
        getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
}
    },
    mounted() {
        // Fetch initial set of posts when the component is created
        this.fetchPosts();
        this.fetchUserInfo();
        console.log("PROFILE USER ID");
        console.log(this.getParameterByName('User_ID'));
    },
};
</script>

<style scoped>
    .edit-profile-btn {
        position: fixed;
        bottom: 20px; 
        right: 20px; 
        z-index: 999;
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        border: none; 
        border-radius: 5px;
        cursor: pointer;
    }
    .Fixed-navbar{
    position: fixed;
    width: 100%;
    z-index: 1000;
    top: 0;
    }
    .header-content{
        margin-top: 30px;
    }
</style>
