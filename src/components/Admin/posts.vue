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
                <tr v-for="(post,index) in displayedPosts()" :key="post.post_ID">
                    <td>{{ post.Username }}</td>
                    <td>
                        <button @click="showContent(index)" class="btn btn-outline-secondary">Read Content</button>
                    </td>
                    <td>
                        <button @click="showMedia(index)" class="btn btn-outline-secondary">View Media</button>
                    </td>
                    <td>
                        <button @click="showComments(index)" class="btn btn-outline-secondary">View Comments</button>
                    </td>
                    <td>
                        <button @click="deletePost(post.Post_ID)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr v-if="showMoreButton()">
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
</template>

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                Posts: [
                    {
                        post_ID: 1,
                        Username: 'User 1',
                        Content: 'This is a post from user 1',
                        Media: 'Image',
                        Comments: [
                            {
                                comment_ID: 1,
                                Username: 'User 2',
                                Content: 'Nice Post'
                            }
                        ]
                    },
                ],
                displayedPostsCount: 5,
                mediaShown: NaN,
                commentsShown: NaN
            }
        },
        methods: {
            deletePost(Post_ID) {
                let data = new FormData();
                data.append('Post_ID',Post_ID);
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=deletePost`, data)
                    .then(response => {
                        console.log("Post Deleted");
                        console.log(response);
                        this.fetchPosts();
                    })
                    .catch(error => {
                        console.error('Error Deleting Post:', error);
                    });
            },
            showContent(index) {
                alert(this.Posts[index].Content);
            },
            showMedia(index) {
                if(this.mediaShown!=index)
                {
                    this.mediaShown=index;
                }
                else
                {
                    this.mediaShown=NaN;
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
            displayedPosts() {
                return this.Posts.slice(0, this.displayedPostsCount);
            },
            showMoreButton() {
                return this.displayedPostsCount < this.Posts.length;
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
                console.log("admin posts");
                console.log(result);
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
</style>