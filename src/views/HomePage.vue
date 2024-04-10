<template>
  <div>
    <div class="Fixed-navbar">
      <navBar/>
    </div>
    <div class="row">
      <div class="fixed-column left">
        <ProfileCard :showUploadButton="false"/>
      </div>
      <div class="scrollable-column" ref="scrollableColumn">
          <PostSection :Posts="visiblePosts()" @postAdded="handlePostAdded()" @postDeleted="handlePostDeleted()"/>
          <p v-if="visiblePostCount - Posts.length > 0" class="Note">No more posts to load</p>
    <button v-if="Posts.length > 8" class="btn btn-info"  @click="loadMorePosts()">Load More</button>
      </div>
      <div class="fixed-column right">
        <Inbox/>
      </div>
    </div>
  </div>
</template>

<script>
  import PostSection from '@/components/HomePage/PostSection.vue';
  import navBar from '@/components/navbar.vue';
  import Inbox from '@/components/MessageBox/Inbox.vue';
  import ProfileCard from '@/components/EditProfile/ProfileCard.vue';
  import axios from 'axios';
  export default {
    components: {
      PostSection,
      navBar,
      Inbox,
      ProfileCard
    },
    data(){
      return {
        Posts : [],
        visiblePostCount: 8
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
                        content: post.Caption,
                        img: post.Media ?require('../back/uploads/' + post.Media) : "",
                        alt: 'Post Image',
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked:post.isLiked,
                        Post_ID : post.Post_ID,
                        React_Count : post.React_Count,
                        date: post.Date_published
                        
                    };
                }
              

            const sessionId = sessionStorage.getItem('sessionId');
            let data =new FormData();
            if (sessionId !== null) {
                data.append('sessionId', sessionId);
            }
            axios.post(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getAllPosts`,data)
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
  }
}

</script>

<style>

/* Styling for the row layout */
.row {
  display: flex;
  flex-wrap: wrap;
  padding-top: 60px;
}
.Fixed-navbar{
  position: fixed;
  width: 100%;
  z-index: 1000;
}
.fixed-column {
  position: fixed;
  height : 92%;
  bottom: 0;
  overflow-y: auto;
}
.fixed-column.left {
  left: 0;
  width: 20%;
}
.fixed-column.left::-webkit-scrollbar {
  display: none;
}

.fixed-column.right {
  right: 0;
  width: 20%;
}
.scrollable-column {
  flex-grow: 1;
  overflow-y: auto;
  padding-left: 23%;
  padding-right: 23%;
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
