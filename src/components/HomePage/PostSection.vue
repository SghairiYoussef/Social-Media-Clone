<template>
  <div class="container" v-cloak>
    <div class="user_post" v-if="routePath ==='/Home' || routePath==='/myAccount'">
      <div class="post_content_wrapper">
        <img class="user_img" :src="avatar" alt="User Image">
        <div class="post-text-wrapper">
          <textarea class="form-control rounded post_input" v-model="newPost.newContent" placeholder="Write something here..." rows="3"></textarea>
          <div class="button-wrapper">
            <label for="file" class="btn btn-success media_button">
              <input id="file" class="file_input" type="file" name="file" accept="image/*" style="display: none;">
              <i class="fas fa-image"></i> Image
            </label>
            <button type="button" class="btn btn-info" @click="addPost(newPost.newContent)">
              <i class="fas fa-paper-plane"></i> Post
            </button>
          </div>
        </div>
      </div>
    </div>


    <div v-if="Posts.length > 0" class="post-container">
      <div class="post" v-for="(post,index) in this.Posts" :key="index" >
        <div class="post_header" >
          <div class="post_info">
            <img class="user_img" :src="post.user.img" :alt="post.user.alt">
            <div class="user_details">
              <p @click="selectUser(post.user.id)"><strong>{{post.user.name}}</strong></p>
              <p>{{formatMessageTime(post.date)}}</p>
            </div>
          </div>
          <button @click="deletePost(post)" class="btn btn-outline-danger delete_button" v-if="isLoggedIn(post.user.id)">
            <i class="far fa-trash-alt"></i> Delete
          </button>
        </div>
        <div class="post_content">
          <p class="post_text">{{ post.content }}</p>
          <div class="image-container">
            <img v-if="post.img !== ''" class="post_image" :src="post.img" :alt="post.alt">
          </div>
        </div>

        <div class="post-footer d-flex justify-content-center">
          <button type="button" class="btn btn-outline-primary mr-1" @click="react(post)" :style="{ 'background-color': post.isLiked ? '#007bff' : 'white' }">
            <i class="far fa-thumbs-up mr-1" :style="{ 'color': post.isLiked ? 'white' : '#007bff' }"></i>
            <span class="badge badge-light">{{ post.React_Count }}</span>
          </button>
          <button type="button" class="btn btn-outline-secondary mx-1" @click="comment(post)">
            <i class="far fa-comment"></i>
          </button>
          <button type="button" class="btn btn-outline-warning ml-1" @click="share(post)">
            <i class="fas fa-share"></i>
          </button>
        </div>



        <comments v-bind:post="post" v-bind:comments="comments" v-if="post.commentsShown"
                  @commentAdded="handleCommentAdded(post)"/>

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
      },
      comments: [],
      routePath: '',
      avatar: require('../../../public/img/noProfileImage.jpg')
    }
  },
  mounted() {
    this.fetchAvatar();
  },
  props: ['Posts'],
  methods: {
    deletePost(post) {
      let data = new FormData();
      data.append('Post_ID', post.Post_ID);
      axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=deletePost`, data)
          .then(response => {
            console.log("Post Deleted");
            this.$emit('postDeleted', response);
          })
          .catch(error => {
            console.error('Error Deleting Post:', error);
          });
    },
    closeComments() {
      this.Posts.forEach(post => {
        post.commentsShown = false;
      });
    },
    comment(post) {
      const state = post.commentsShown;
      this.closeComments();
      post.commentsShown = !state;
      this.fetchComments(post);


    },
    fetchComments(post) {
      let data = new FormData();
      data.append('Post_ID', post.Post_ID);
      axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getComments`, data)
          .then(response => {
            this.comments = response.data;
            this.comments.forEach(comment => {
              comment.img = comment.img === null ? require('../../../public/img/noProfileImage.jpg') : require(`../../back/avatars/${comment.img}`);
            });

          })
          .catch(error => {

            console.error('Error fetching comments:', error);
          });
    },
    addPost(content) {
      this.newPost = {
        newContent: '',
      };
      let fileInput = document.querySelector('input[type="file"]');
      if (content === '') {
        alert('Please fill in the content field!');
        return;
      }
      let data = new FormData();
      data.append('Content', content);
      data.append('Media', fileInput.files[0]);
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
    handleCommentAdded(post) {
      this.fetchComments(post);
    },
    share(post) {
      let data = new FormData();
      data.append('Post_ID', post.Post_ID);
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
    react(post) {
      let data = new FormData();
      const currentUserID = sessionStorage.getItem('userId');
      data.append('Post_ID', post.Post_ID);
      data.append('User_ID', currentUserID);
      axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=reactToPost`, data)
          .then(response => {
            this.$emit('postAdded', response);
            console.log('isLiked');
          })
          .catch(error => {
            console.error('Error Deleting Post:', error);
          });
    },
    isLoggedIn(id) {
      const currentUserID = sessionStorage.getItem('userId');
      return currentUserID == id;
    },
    selectUser(User_ID) {
      const currentUserID = sessionStorage.getItem('userId');
      if (currentUserID == User_ID) {
        this.$router.push(`/myAccount`);
      } else {
        this.$router.push(`/profile?User_ID=${User_ID}`);
      }

    },
    fetchAvatar() {
      let data = new FormData();
      let sessionId = sessionStorage.getItem('sessionId');
      data.append('sessionId', sessionId);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/EditProfileAPI.php?action=fetchAvatar', data)
          .then(response => {
            if (response.data.success) {
              if (response.data.path !== null) {
                this.avatar = require('../../back/avatars/' + response.data.path);
              }
            }
          })
          .catch(error => {
            console.error('Error fetching profile details:', error);
          });
    },
    formatMessageTime(time) {
      const messageTime = new Date(time);
      const today = new Date();
      if (
          messageTime.getDate() === today.getDate() &&
          messageTime.getMonth() === today.getMonth() &&
          messageTime.getFullYear() === today.getFullYear()
      ) {
        let hours = messageTime.getHours();
        let suffix = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const minutes = messageTime.getMinutes().toString().padStart(2, '0');
        return `${hours}:${minutes} ${suffix}`;
      } else {
        const months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
        const year = (messageTime.getFullYear() !== today.getFullYear()) ? `, ${messageTime.getFullYear()}` : '';
        const month = months[messageTime.getMonth()];
        const day = messageTime.getDate();
        let hours = messageTime.getHours();
        let suffix = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const minutes = messageTime.getMinutes().toString().padStart(2, '0');
        const time = `${year}, ${month}, ${day} at ${hours}:${minutes} ${suffix}`;
        return time.substring(1);
      }
    }

  },
  created() {
    this.routePath = window.location.pathname;
  },
  components: {
    comments: CommentSection
  }
};
</script>

<style>
.post_info {
  display: flex;
  align-items: center;
  margin-bottom: 10px; /* Adjust as needed */
}

.user_img {
  width: 50px; /* Adjust size as needed */
  height: 50px; /* Adjust size as needed */
  border-radius: 50%; /* Make the image round */
  margin-right: 10px; /* Add space between image and text */
}

.user_details {
  flex-grow: 1; /* Take up remaining space */
}

.user_details p {
  margin: 0; /* Remove default margins */
}

.post_content_wrapper {
  width: 100%;
  display: flex;
  margin-bottom: 10px; 
}

.post-text-wrapper {
  width: 100%;
  flex-grow: 1;
}

.post_image {
  width: 100%; /* Ensure image doesn't exceed container width */
  height: 400px; /* Maintain aspect ratio */
  border-radius: 5px; /* Add rounded corners to the image */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add subtle shadow for depth */
  margin-top: 10px; /* Add space above the image */
  margin-bottom: 10px; /* Add space below the image */
}
.post_header {
  display: flex;
  justify-content: space-between; /* Align items with space between them */
  align-items: center; /* Vertically center items */
}

.delete_button {
  padding: 5px 10px; /* Adjust padding */
  border-radius: 5px; /* Add rounded corners */
  background-color: #dc3545; /* Red background color */
  color: #fff; /* White text color */
  border: none; /* Remove border */
  transition: background-color 0.3s ease; /* Smooth transition for background color */
  margin-bottom: 10px; /* Add space above the button */
}

.delete_button:hover {
  background-color: #c82333; /* Darker red on hover */
}
.post-footer {
  display: flex;
  justify-content: space-between; /* Distribute items equally */
  align-items: center; /* Center-align items vertically */
  margin-top: 10px; /* Add some top margin */
}

.post-footer .btn {
  flex-grow: 1; /* Make buttons occupy equal space */
  max-width: 25%; /* Limit maximum width for equal spacing */
}
.user_post {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}
.post_text {
  flex-grow: 1;
}


.post_input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  resize: vertical;
}

.button-wrapper {
  display: flex;
  align-items: center;
}

.media_button {
  margin-top: 26.5px;
  margin-right: 40px;
  margin-left: calc(45% - 100px);
}

.fa-image {
  font-size: 20px;
  margin-right: 10px;
  color: #ffffff;
}
</style>
