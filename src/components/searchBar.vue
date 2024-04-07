<template>
  <div class="search-bar">
    <input type="text" class="form-control me-2" v-model="input" placeholder="Search..." @input="handleInput" @keydown.enter="handleEnter" @keydown.esc="clearInput" />
    <button class="clear-button" @click="clearInput" v-if="input">Clear</button>
    <div v-if="input" class="search-results">
      <div class="item fruit" v-for="user in filteredList" :key="user.id">
        <div class="user-item" @click="selectUser(user.userID)">
          <img :src="user.avatar" alt="profilePic" class="user-searchbar-avatar" />
          <p>{{ user.username }}</p>
        </div>
      </div>
      <div class="item error" v-if="!filteredList.length">
        <p>No results found!</p>
      </div>
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
        return this.users.filter(user =>
            user.username.toLowerCase().includes(this.input.toLowerCase())
        );
      } else {
        console.error('Users prop is not an array.');
        return [];
      }
    }
  },
  methods: {
    handleInput() {
      // Implement debounce functionality here if needed
    },
    handleEnter() {
      if (this.filteredList.length === 1) {
        this.selectUser(this.filteredList[0].id);
      }
    },
    clearInput() {
      this.input = '';
    },
    selectUser(User_ID) {
      const currentUserID = sessionStorage.getItem('userId');
      if (currentUserID == User_ID) {
        this.$router.push(`/myAccount`);
      } else {
        this.$router.push(`/profile?User_ID=${User_ID}`);
      }
    }
  }
}
</script>

<style scoped>
.search-bar {
  position: relative;
  width: 100%;
}

.form-control {
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  border: 1px solid #d3e0f5;
}

.clear-button {
  position: absolute;
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
  background-color: transparent;
  border: none;
  cursor: pointer;
}

.search-results {
  position: absolute;
  top: 100%;
  left: 0;
  width: 100%;
  background-color: #25253b;
  border: 1px solid #ced4da;
  border-top: none;
  border-radius: 0 0 0.25rem 0.25rem;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
  z-index: 1;
}

.user-searchbar-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-item {
  display: flex;
  align-items: center;
  padding: 10px;
  cursor: pointer;
  color: white;
}

.user-item p {
  margin: 0;
}

.item.error {
  padding: 10px;
  text-align: center;
  color: #ffffff;
}

</style>
