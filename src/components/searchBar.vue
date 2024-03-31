<template>
    <input type="text" class="form-control me-2" v-model="input" placeholder="Search..." />
    <div class="item fruit" v-for="user in filteredList" :key="user">
      <p>{{ user }}</p>
    </div>
    <div class="item error" v-if="input && !filteredList.length">
       <p>No results found!</p>
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
   data() {
     return {
       input: '',
     }
    },
   computed: {
     filteredList() {
       return this.users.filter((user) =>
         user.username.toLowerCase().includes(this.input.toLowerCase())
       );
     }
    },
    name: 'SearchBar'
 }
 </script>
 