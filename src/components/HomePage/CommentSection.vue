<template>
    <div class="comment-section">
        <div class="comment-section__header">
            <h2>Comments</h2>
        </div>
        <div class="comments">
            <div class="comment" v-for="(comment, index) in post.comments" :key="index">
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
            <textarea class="comment-section__form__input" placeholder="Write a comment"></textarea>
            <button class="comment-section__form__button">Post</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: true
            }
        }
    }
</script>