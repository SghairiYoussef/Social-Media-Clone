<template>
    <div class="container" v-cloak>
            <div class="user_post">
                <img class="user_img" src="https://wweb.dev/resources/navigation-generator/logo-placeholder.png" alt="User Image">
                <input class="post_input" v-model="newPost.newTitle" type="text" placeholder="Your Post Title here!">
                <input class="post_input" v-model="newPost.newContent" type="text" placeholder="What's on your mind?">
                <button type="button" class="btn btn-outline-info" @click="addPost(newPost.newContent, newPost.newTitle)">Post</button>
            </div>
            <div class="post" v-for="post in reversedPosts" :key="post.title">
                <div class="post_header">
                    <img class = user_img :src="post.user.img" :alt="post.user.alt">
                    <p><strong>{{post.user.name}}:</strong> {{post.title}}</p>
                </div>
                <img :src="post.img" :alt="post.alt">
                <p>{{post.content}}</p>
                <div class="post-footer">
                    <button type="button" class="btn btn-outline-primary">React</button>
                    <button type="button" class="btn btn-outline-secondary" @click="comment(post)">Comment</button>
                    <button type="button" class="btn btn-outline-warning">Share</button>
                </div>
                <comments :post="post" v-if="post.commentsShown"/>
            </div>
        </div>
</template>

<script>
import CommentSection from './CommentSection.vue';
import axios from 'axios';
export default {
        data() {
            return {
                Posts: [/*
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
                        newCommentContent: '',
                        isLiked : false
                    },
                    {
                        user: {
                            name: 'John Doe',
                            img: 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                            alt: 'User Image'
                        },
                        title: 'Post 2',
                        content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                        img: 'https://via.placeholder.com/800x400',
                        alt: 'Post Image',
                        comments: [],
                        commentsShown: false,
                        newCommentContent: ''
                    },
                    {
                        user: {
                            name: 'John Doe',
                            img: 'https://wweb.dev/resources/navigation-generator/logo-placeholder.png',
                            alt: 'User Image'
                        },
                        title: 'Post 3',
                        content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae efficitur ante.',
                        img: 'https://via.placeholder.com/800x400',
                        alt: 'Post Image',
                        comments: [],
                        commentsShown: false,
                        newCommentContent: ''
                    }*/
                ],
                newPost: {
                    newContent: '',
                    newTitle: ''
                },
            }
        },
        mounted() {
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
                        comments: post.comments ? post.comments.map(comment => ({ content: comment })) : [],
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked: false
                    };
                }

            axios.get(`http://localhost8081/Social-Media-Clone/src/back/api.php?action=getAllPosts`)
            .then(response => {
                
                 console.log(response);
                let result = response.data;
                result = result.map(post=>transformPost(post))
                this.posts = result;
                console.log(this.posts);
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
        },
        computed: {
            reversedPosts() {
                return this.Posts.slice().reverse();
            }
        },
        methods: {
            comment(post) {
                post.commentsShown = !post.commentsShown;
            },
            addPost(content, title) {
                const newPostc = { title: title, content: content, img: 'https://via.placeholder.com/800x400', alt: 'Post Image', comments: [], commentsShown: false, newCommentContent: '', user: {name: '', img:'https://wweb.dev/resources/navigation-generator/logo-placeholder.png', alt: 'User img' } };
                this.Posts.push(newPostc);
                this.newContent = '';
            },
        },
        components: {
            comments: CommentSection
        }
    };
</script>