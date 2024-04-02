<template>
    <div class="comment-section">
        <div class="comment-section__header">
            <h2>Comments</h2>
        </div>
        <div class="comments">
            <div class="comment" v-for="(comment, index) in comments" :key="index">
                <div class="comment__user">
                    <img src="https://wweb.dev/resources/navigation-generator/logo-placeholder.png" alt="User"/>
                </div>
                <div class="comment__content">
                    <p class="comment__content__text">{{comment.Content}}</p>
                    <p class="comment__content__date">{{comment.Date_Posted}}</p>
                </div>
            </div>
        </div>
        <div class="comment-section__form">
            <textarea class="comment-section__form__input" v-model="newComment.newContent" placeholder="Write a comment"></textarea>
            <button class="comment-section__form__button" @click="addComment(post.Post_ID,newComment.newContent)">Post</button>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                newComment: {
                    newContent: '',
                },
            }
        },
        props: {
            post: {
                type: Object,
                required: true
            },
            comments: {
                type: Array,
                required: true
            }
        },
        methods : {
            addComment(post_id,content) {
                
                this.newComment = {
                    newContent: ''
                };
                let data = new FormData();
                data.append('Content',content);
                data.append('Post_ID',post_id);
                const sessionId = sessionStorage.getItem('sessionId');
                if (sessionId !== null) {
                    data.append('sessionId', sessionId);
                }
                
                axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=addComment`, data)
                    .then(response => {
                        console.log("Comment Added");
                        console.log(response);
                        this.$emit('commentAdded', response);
                    
                    })
                    .catch(error => {
                
                    console.error('Error Adding Comment:', error);
                    });
            }
        }
    }
</script>