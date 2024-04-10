<template>
    <div class="table-container">
        <table class="table table-striped table-dark table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Content</th>
                    <th>Media</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="Posts.length === 0">
                    <td colspan="5" class="Note">No Posts found</td>
                </tr>
                <tr v-for="(post,index) in displayedPosts" :key="post.post_ID">
                    <td>{{ post.Username }}</td>
                    <td>
                        <button @click="showContent(index)" class="btn btn-outline-secondary">Read Content</button>
                    </td>
                    <td>
                        <button @click="showMedia(post.Media)" class="btn btn-outline-secondary">View Media</button>
                    </td>
                    <td>
                        <button @click="showComments(index)" class="btn btn-outline-secondary">View Comments</button>
                    </td>
                    <td>
                        <button @click="deletePost(post.Post_ID)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr v-if="showMoreButton">
                    <td colspan="5">
                        <button @click="loadMorePosts()" class="btn btn-primary">Show More</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div v-if="mediaShown!=NaN && Posts[mediaShown] && Posts[mediaShown].Media">
                {{ Posts[mediaShown].Media }}
            </div>
        </div>
        <div class="col-sm-6">
            <div v-if="commentsShown!=NaN && Posts[commentsShown] && Posts[commentsShown].Comments">
                <div v-for="comment in Posts[commentsShown].Comments" :key="comment.comment_ID">
                    <p>{{ comment.userName }}</p>
                    <p>{{ comment.Content }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="image-container" v-if="mediaShown">
        <img :src="mediaShown" alt="Media Image" style="max-width: 100%; height: auto;">
    </div>
    <div class="image-container" v-else>
        <p v-if="viewMedia">No Media to show</p>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                Posts: [],
                displayedPostsCount: 8,
                mediaShown: "",
                commentsShown: NaN,
                viewMedia: false
            }
        },
        computed: {
            displayedPosts() {
                return this.Posts.slice(0, this.displayedPostsCount);
            },
            showMoreButton() {
                return this.displayedPostsCount < this.Posts.length;
            }
        },
        methods: {
            deletePost(Post_ID) {
                let data = new FormData();
                data.append('Post_ID',Post_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=deletePost`, data)
                    .then(response => {
                        console.log(response.data.message);
                        if(response.data.success) {
                          this.fetchPosts();
                        }
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
            },
            showContent(index) {
                alert(this.Posts[index].Content);
            },
            showMedia(media) {
                this.viewMedia = true;
                if (media){
                    this.mediaShown = require(`../../back/uploads/${media}`);
                }
                else
                {
                    this.mediaShown = "";
                }
            },
            showComments(index) {
                if (this.commentsShown!=index)
                {
                    this.commentsShown=index;
                }
                else
                {
                    this.commentsShown=NaN;
                }
            },
            loadMorePosts() {
                this.displayedPostsCount += 5;
            },
            fetchPosts(){
                function transformPost(post) {

                    return {
                        Username: post.userName,
                        Content: post.Caption,
                        Media: post.Media,
                        Comments: post.Comments,
                        Post_ID : post.Post_ID
                    };
                }

                axios.get(`http://localhost/php/Social-Media-Clone/src/back/AdminApi.php?action=getAllPosts`)
            .then(response => {
                
                let result = response.data;
                result = result.map(post=>transformPost(post));
                this.Posts = result;
                
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
            }
        },
        name: 'postSection',
        mounted(){
            this.fetchPosts();
        }
    }
</script>
<style>
    .table {
        width: 90%;
        margin: 20px auto;
        margin-top:10px auto ;
    }
    .table-container {
        margin-right: 40px;
        background-color: #9a8c98;
        color: white;
        padding: 20px;
        border-radius: 20px;
    }
    .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }
</style>