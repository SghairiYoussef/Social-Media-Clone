<template>
  <div class="comment-section">
    <div class="comment-section__header">
      <h2>Comments</h2>
    </div>
    <div class="comments" style = "background-color: #ffffff">
      <div class="comment" v-for="(comment, index) in comments" :key="index">
        <div class="comment__content">
          <div class="comment__user">
            <img :src="comment.img" alt="User"/>
            <p>{{comment.userName}}</p>
          </div>
          <p class="comment__content__text">{{comment.Content}}</p>
          <p class="comment__content__date">{{comment.Date_Posted}}</p>
        </div>
      </div>
    </div>
    <div class="comment-section__form">
      <textarea class="comment-section__form__input" v-model="newComment.newContent" placeholder="Write a comment"></textarea>
      <button class="comment-section__form__button" @click="addComment(post.Post_ID,newComment.newContent)" style="margin-left: 20px;">Post </button>
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
      }
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
            this.$emit('commentAdded', response);

          })
          .catch(error => {

            console.error('Error Adding Comment:', error);
          });
    }
  }
}
</script>

<style scoped>
.comment-section {

  padding: 20px;
  margin-bottom: 20px;
}

.comment-section__header {
  margin-bottom: 10px;
}

.comment {
  display: flex;
  margin-bottom: 15px;
}

.comment__user img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 10px;
}

.comment__user p {
  font-weight: bold;
  margin-bottom: 15px;
}

.comment__content {
  flex: 1;
}

.comment__content__text {
  margin-bottom: 10px;
}

.comment-section__form {
  margin-top: 20px;
  display: flex;
  align-items: center;
}

.comment-section__form__input {
  justify-content: center;
  width: 75%;
  height: 50px;
  resize: vertical;
  margin-bottom: 10px;
  padding-left: 10px;
}

.comment-section__form__button {
  display: block;
  justify-content:  center;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  height: 40px;
  width: 70px;
}

.comment-section__form__button:hover {
  background-color: #0056b3;
}
</style>
