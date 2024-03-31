<template>
    <div class="container" v-cloak>
        <div class="user_post">
            <img class="user_img" src="https://wweb.dev/resources/navigation-generator/logo-placeholder.png" alt="User Image">
            <input class="post_input" v-model="newPost.newTitle" type="text" placeholder="Your Post Title here!">
            <input class="post_input" v-model="newPost.newContent" type="text" placeholder="What's on your mind?">
            <input class="post_input" type="file" accept="image/*">
            <button type="button" class="btn btn-outline-info" @click="addPost(newPost.newContent, newPost.newTitle)">Post</button>
        </div>
        
        <div v-if="Posts.length > 0">
            <div class="post" v-for="post in this.Posts" :key="post.title" >
                <div class="post_header">
                    <img class = user_img :src="post.user.img" :alt="post.user.alt">
                    <p><strong>{{post.user.name}}:</strong> {{post.title}}</p>
                    <button @click="deletePost(post)" class="btn btn-outline-danger" style="align-self: flex-end;">Delete Post</button>
                </div>
                <img :src="post.img" :alt="post.alt">
                <p>{{post.content}}</p>
                <div class="post-footer">
                    <button type="button" class="btn btn-outline-primary">
                        React
                        <span class="badge badge-light">{{post.reacts}}</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" @click="comment(post)">Comment</button>
                    <button type="button" class="btn btn-outline-warning">Share</button>
                </div>
                <comments :post="post" :comments="PostComment" v-if="post.commentsShown"/>
            </div>
        </div>
        <div v-else>
            <p class="Note">No Posts to show</p>
        </div>
    </div>
</template>

<script>
import CommentSection from './CommentSection.vue';
import axios from 'axios';
export default {
        data() {
            return {
                newPost: {
                    newContent: '',
                    newTitle: ''
                },
            }
        },
        props:['Posts'],
        methods: {
            deletePost(post){
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=deletePost`, post)
                    .then(response => {
                        console.log("Post Deleted");
                        console.log(response);
                        this.$emit('postDeleted', response);
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
                    //hedha ketbou copilot, manaersh est-ce que sehih wla ghalet, fix it
            },
            comment(post) {
                post.commentsShown = !post.commentsShown;
            },
            addPost(content, title, Media ="") {
                this.newPost = {
                    newContent: '',
                    newTitle: ''
                };
                let data = new FormData();
                data.append('Content',content);
                data.append('Title',title);
                data.append('Media',Media);
                console.log('posting data');
                console.log(data);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=addPost`, data)
                    .then(response => {
                        console.log("Post Added");
                        console.log(response);
                        this.$emit('postAdded', response);
                    
                    })
                    .catch(error => {
                
                    console.error('Error Adding Post:', error);
                    }); 
            },
            
        },
        components: {
            comments: CommentSection
        }
    };
</script>