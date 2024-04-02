<template>
    <input type="text" class="form-control me-2" v-model="input" placeholder="Search..." />
    <div v-if="input">
      <div class="item fruit" v-for="user in filteredList" :key="user">
        <p @click="selectUser">{{ user.username }}</p>
      </div>
      <div class="item error" v-if="!filteredList.length">
        <p>No results found!</p>
      </div>
  </div>
</template>
 
<script>
 
 export default {
   props: {
        users: {
            type: Array,
            required: true
        },
    },
    name: 'SearchBar',
   data() {
     return {
       input: '',
     }
    },
   computed: {
     filteredList() {
      if (Array.isArray(this.users)) {
        let result= this.users.filter(user =>
          user.username.toLowerCase().includes(this.input.toLowerCase())
        );
        return result;
      } else {
        console.error('Users prop is not an array.');
        return [];
      }
     }
    },
    methods: {
      selectUser() {
        this.$router.push('/profile');
      }
    }
 }
 
</script>
