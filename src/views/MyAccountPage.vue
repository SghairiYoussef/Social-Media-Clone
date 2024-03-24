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
    <div v-if="posts.length > 0">
        <PostSection v-for="post in visiblePosts" :key="post.id" :post="post"/>
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

export default {
    data() {
        return {
            user: {
                id: 1,
                name: 'John Doe',
                username: 'johndoe',
                email: 'john@example.com',
                avatar: 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                background: 'https://wweb.dev/resources/navigation-generator/logo-placeholder-background.png',
                bio: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            },
            posts: [
                {
                    user: {
                            name: 'John Doe',
                            img: 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                            alt: 'User Image'
                        },
                        title: 'Post 1',
                        content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                        img: 'https://via.placeholder.com/800x400',
                        alt: 'Post Image',
                        comments: [
                            {content: 'Comment 1'},
                            {content: 'Comment 2'},
                            {content: 'Comment 3'}
                        ],
                        commentsShown: false,
                        newCommentContent: ''
                }
            ],
            visiblePostCount: 8,
        };
    },
    components: {
        PostSection,
        navBar
    },
    computed: {
        visiblePosts() {
            return this.posts.slice(0, this.visiblePostCount);
        },
        hasMorePosts() {
            return this.visiblePostCount < this.posts.length;
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
            // Example: Fetch posts from an API
            // Replace this with an API call
            fetch('https://api.example.com/posts')
            .then(response => response.json())
            .then(data => {
                this.posts = data; // Update posts array with fetched data
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
            });
        },
    },
    created() {
        // Fetch initial set of posts when the component is created
        this.fetchPosts();
    },
};
</script>
