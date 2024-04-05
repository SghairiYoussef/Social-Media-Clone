<template>
  <navBar/>
  <div class="row">
    <div class = "col-sm-10">
      <PostSection :Posts="visiblePosts()" @postAdded="handlePostAdded()" @postDeleted="handlePostDeleted()"/>
      <button class="btn btn-info" v-if="hasMorePosts()" @click="loadMorePosts()">Load More</button>
      <div v-else>
          <p class="Note">No more posts to load</p>
      </div>
    </div>
    <div class = "col-sm-2">
      <Inbox/>
    </div>
  </div>
</template>

<style>

/* Styling for the row layout */
.row {
  display: flex;
  flex-wrap: wrap;
}

/* Styling for the left column */
.col-sm-10 {
  flex: 0 0 83.333333%;
  max-width: 83.333333%;
}

/* Styling for the right column */
.col-sm-2 {
  flex: 0 0 16.666667%;
  max-width: 16.666667%;
}

/* Styling for the load more button */
.btn-info {
  background-color: #17a2b8; /* Button color */
  color: #fff; /* Text color */
  margin-top: 20px; /* Spacing from the posts section */
  padding: 10px 20px; /* Padding */
  border: none; /* No border */
  border-radius: 5px; /* Rounded corners */
  cursor: pointer; /* Pointer cursor */
  transition: background-color 0.3s ease; /* Smooth transition */
}

.btn-info:hover {
  background-color: #138496; /* Darker color on hover */
}

/* Styling for the note when no more posts to load */
.Note {
  color: #777; /* Text color */
  margin-top: 20px; /* Spacing from the button */
}

</style>


<script>
  import PostSection from '@/components/HomePage/PostSection.vue';
  import navBar from '@/components/navbar.vue';
  import Inbox from '@/components/MessageBox/Inbox.vue';
  import axios from 'axios';
  export default {
    components: {
      PostSection,
      navBar,
      Inbox
    },
    data(){
      return {
        Posts : [],
      }
    },
    methods:{
      fetchPosts(){
        function transformPost(post) {
                    return {
                        user: {
                            id:post.userID,
                            name: post.userName,
                            img: post.img ? require('../back/avatars/' + post.img) : require('../../public/img/noProfileImage.jpg'),
                            alt: 'User Image'
                        },
                        title: post.title,
                        content: post.Caption,
                        img: post.Media ?require('../back/uploads/' + post.Media) : "",
                        alt: 'Post Image',
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked: false,
                        Post_ID : post.Post_ID,
                        React_Count : post.React_Count,
                        date: post.Date_published
                    };
                }

            axios.get(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getAllPosts`)
            .then(response => {
                let result = response.data;
                result = result.map(post=>transformPost(post));
                this.Posts = result;
                
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
      },visiblePosts() {
        return this.Posts.slice(0, this.visiblePostCount);
      },
      hasMorePosts() {
        return this.visiblePostCount < this.Posts.length;
      },
      loadMorePosts() {
        this.visiblePostCount += 5;
      },
      handlePostAdded() {
        this.fetchPosts();
      },
      handlePostDeleted(){
            this.fetchPosts();
        }
      
    },
    created() {
          this.fetchPosts();
        },
  }
  
</script>
