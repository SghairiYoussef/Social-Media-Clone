<template>
    <div class="container" v-cloak>
        <div class="user_post" v-if="routePath ==='/Home' || routePath==='/myAccount'">
            <img class="user_img" :src="avatar" alt="User Image">
            <input class="post_input" v-model="newPost.newTitle" type="text" placeholder="Your Post Title here!">
            <input class="post_input" v-model="newPost.newContent" type="text" placeholder="What's on your mind?">
            <input class="post_input" type="file" name="file" accept="image/*" >
            <button type="button" class="btn btn-outline-info" @click="addPost(newPost.newContent, newPost.newTitle)">Post</button>
        </div>
        
        <div v-if="Posts.length > 0">
            <div class="post" v-for="post in this.Posts" :key="post.title" >
                <div class="post_header" >
                    <div @click="selectUser(post.user.id)">
                        <img class = user_img :src="post.user.img" :alt="post.user.alt">
                        <p><strong>{{post.user.name}}:</strong> {{post.title}}</p>
                      <p>{{post.date}}</p>
                    </div>
                    <button @click="deletePost(post)" class="btn btn-outline-danger" style="align-self: flex-end;" v-if="isLoggedIn(post.user.id)===true">Delete Post</button>
                </div>
                <img v-if="post.img !== ''" :src="post.img" :alt="post.alt">
                <p>{{post.content}}</p>
                <div class="post-footer">
                    <button type="button" class="btn btn-outline-primary" @click="react(post)">
                        React
                        <span class="badge badge-light">{{post.React_Count}}</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" @click="comment(post)">Comment</button>
                    <button type="button" class="btn btn-outline-warning" @click="share(post)">Share</button>
                </div>

                <comments v-bind:post="post" v-bind:comments="comments" v-if="post.commentsShown" @commentAdded="handleCommentAdded(post)" />

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
                comments :[],
                routePath:'',
                avatar: require('../../../public/img/noProfileImage.jpg')
            }
        },
        mounted(){
            this.fetchAvatar();
        },
        props:['Posts'],
        methods: {
            deletePost(post){
                let data = new FormData();
                data.append('Post_ID',post.Post_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=deletePost`, data)
                    .then(response => {
                        console.log("Post Deleted");
                        this.$emit('postDeleted', response);
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
            },
            comment(post) {
                post.commentsShown = !post.commentsShown;
                this.fetchComments(post);
                

            },
            fetchComments(post){
                let data = new FormData();
                data.append('Post_ID',post.Post_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getComments`, data)
                    .then(response => {
                        this.comments=response.data;
                        this.comments.forEach(comment => {
                        comment.img = require('../../back/avatars/' + comment.img);
                      });

                    })
                    .catch(error => {
                
                    console.error('Error fetching comments:', error);
                    }); 
            },
            addPost(content, title) {
                this.newPost = {
                    newContent: '',
                    newTitle: ''
                };
                let fileInput = document.querySelector('input[type="file"]');
                if (content === '' || title === '') {
                    alert('Please fill in the title and content fields!');
                    return;
                }
                let data = new FormData();
                data.append('Content',content);
                data.append('Title',title);
                data.append('Media',fileInput.files[0]);
                console.log('posting data');
                const sessionId = sessionStorage.getItem('sessionId');
                if (sessionId !== null) {
                    data.append('sessionId', sessionId);
                }
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=addPost`, data)
                    .then(response => {
                        console.log("Post Added");
                        this.$emit('postAdded', response);
                        fileInput.value = '';
                    
                    })
                    .catch(error => {
                
                    console.error('Error Adding Post:', error);
                    }); 
            },
            handleCommentAdded(post){
                this.fetchComments(post);
            },
            share(post){
                let data = new FormData();
                data.append('Post_ID',post.Post_ID);
                const sessionId = sessionStorage.getItem('sessionId');
                data.append('sessionId', sessionId);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=sharePost`, data)
                    .then(response => {
                        this.$emit('postAdded', response);
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
            },
            react(post){
                let data = new FormData();
                const currentUserID = sessionStorage.getItem('userId');
                data.append('Post_ID',post.Post_ID);
                data.append('User_ID',currentUserID);
                console.log(post.Post_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=reactToPost`, data)
                    .then(response => {
                        this.$emit('postAdded', response);
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
            },
            isLoggedIn(id){
                const currentUserID = sessionStorage.getItem('userId');
                return currentUserID == id;
            },
            selectUser(User_ID) {
                const currentUserID = sessionStorage.getItem('userId');
                if(currentUserID == User_ID){
                    this.$router.push(`/myAccount`);
                }else{
                    this.$router.push(`/profile?User_ID=${User_ID}`);
                }
                
            },
            fetchAvatar(){
                let data = new FormData();
                let sessionId = sessionStorage.getItem('sessionId');
                data.append('sessionId', sessionId);
                axios.post('http://localhost/php/Social-Media-Clone/src/back/EditProfileAPI.php?action=fetchAvatar', data)
                .then(response => {
                    if(response.data.success){
                        if (response.data.path !== null){
                        this.avatar = require('../../back/avatars/' + response.data.path);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching profile details:', error);
                });
            }
            
        },
        created(){
            this.routePath=window.location.pathname;
        },
        components: {
            comments: CommentSection
        }
    };
</script>