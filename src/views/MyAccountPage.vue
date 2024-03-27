<template>
    <navBar/>
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
        <PostSection  v-bind:Posts="Posts"/>  <!--v-for="post in visiblePosts" :key="post.id"  -->
        <button class="load-more" v-if="hasMorePosts" @click="loadMorePosts">Load More</button>
        <div v-else>
            <p class="Note">No more posts to load</p>
        </div>
    </div>
    <p class ="Note" v-else>As Empty as a deserted island...!</p>
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
                            name: post.Username,
                            img: post.image ? post.image : 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                            alt: 'User Image'
                        },
                        title: post.title,
                        content: post.Caption,
                        img: post.Media ? post.Media : 'https://via.placeholder.com/800x400',
                        alt: 'Post Image',
                        comments: post.comments,
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked: false
                    };
                }

            axios.get(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getCurrentUserPosts`)
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
                    
                        id: user.User_ID,
                        name : user.fullname,
                        username: user.Username,
                        email: user.mail,
                        avatar: user.image? user.image : 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                        background: user.background? user.background : 'https://wweb.dev/resources/navigation-generator/logo-placeholder-background.png',
                        bio: user.bio,
                    
                    };
                }
                axios.get(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getCurrentUserProfile`)
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
        }
    },
    mounted() {
        // Fetch initial set of posts when the component is created
        this.fetchPosts();
        this.fetchUserInfo();
        console.log("mounted")
    },
};
</script>
