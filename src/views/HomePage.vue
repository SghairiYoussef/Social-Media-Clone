<template>
  <navBar/>
  <PostSection v-bind:Posts="Posts"/>
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
                        isLiked: false
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
        },
  }
  
</script>
