<template>
    <input type="text" class="form-control me-2" v-model="input" placeholder="Search..." />
    <div v-if="input">
      <div class="item fruit" v-for="user in filteredList" :key="user.id">
      <div class="user-item">
        <img :src="user.avatar" alt="profilePic" class="user-searchbar-avatar" />
        <p @click="selectUser(user.id)">{{ user.username }}</p>
      </div>
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
      selectUser(User_ID) {
        const currentUserID = sessionStorage.getItem('userId');
                if(currentUserID == User_ID){
                    this.$router.push(`/myAccount`);
                }else{
                    this.$router.push(`/profile?User_ID=${User_ID}`);
                }
      }
    }
 }
 
</script>

<style scoped>
.user-searchbar-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-item {
  display: flex;
  align-items: center;
}

.user-item p {
  margin: 0;
}

</style>