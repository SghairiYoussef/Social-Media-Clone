<template>
  <navBar/>
  <PostSection/>
</template>

<script>
  import PostSection from '@/components/HomePage/PostSection.vue';
  import navBar from '@/components/navbar.vue';
  export default {
    components: {
      PostSection,
      navBar
    }
  }
</script>
