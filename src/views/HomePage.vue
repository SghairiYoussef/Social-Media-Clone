<template>
  <navBar/>
  <PostSection :Posts="visiblePosts()"/>
  <button class="btn btn-info" v-if="hasMorePosts()" @click="loadMorePosts()">Load More</button>
  <div v-else>
      <p class="Note">No more posts to load</p>
  </div>
</template>

<script>
  import PostSection from '@/components/HomePage/PostSection.vue';
  import navBar from '@/components/navbar.vue';
  import axios from 'axios';
  export default {
    components: {
      PostSection,
      navBar
    },
    methods: {
      visiblePosts() {
        return this.Posts.slice(0, this.visiblePostCount);
      },
      hasMorePosts() {
        return this.visiblePostCount < this.Posts.length;
      },
      loadMorePosts() {
        this.visiblePostCount += 5;
      },
      handlePostAdded(post) {
        this.Posts.unshift(post);
      }
    },
    data(){
      return {
        Posts : [],
      }
    },
    created() {
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
                        comments: post.comments,
                        commentsShown: false,
                        newCommentContent: '',
                        isLiked: false,
                        Post_ID : post.Post_ID
                    };
                }

            axios.get(`http://localhost/php/Social-Media-Clone/src/back/HomeApi.php?action=getAllPosts`)
            .then(response => {
                
                let result = response.data;
                result = result.map(post=>transformPost(post));
                console.log(result);
                this.Posts = result;
                
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
      });
        },
  }
  
</script>
