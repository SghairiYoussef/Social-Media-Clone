<template>
  <div class="chat-container">
    <div class="messages-container" ref="messagesContainer">
      <div v-for="(message, index) in messages" :key="index" :class="{ 'sender-message': isSender(message.from_name), 'receiver-message': !isSender(message.from_name) }" :style="{ 'background-color': isSender(message.from_name) ? '#007bff' : '#f0f0f0' }" class="message">
        <div v-if="!isConsecutive(message.from_name, index)" class="message-sender">{{ message.from_name }}</div>
        <div class="message-content">{{ message.message }}</div>
      </div>
    </div>
    <div class="new-message-container">
      <textarea v-model="newMessage" class="form-control" rows="3" placeholder="Type your message..."></textarea>
      <button @click="sendMessage" class="btn btn-primary send-button">Send</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    selectedUser: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      messages: [],
      newMessage: '',
      currentUser: '',
      isScrolledDown: true
    };
  },
  watch: {
    selectedUser: {
      immediate: true,
      handler(newValue, oldValue) {
        if (newValue !== oldValue) {
          this.isScrolledDown = true;
          this.fetchMessages();
        }
      }
    }
  },
  methods: {
    fetchMessages() {
      let data = new FormData();
      let sessionId = sessionStorage.getItem('sessionId');
      data.append('sessionId', sessionId);
      data.append('userName', this.selectedUser.username);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/messengerApi.php?action=displayMessages', data)
          .then(response => {
            console.log(response.data);
            if(response.data.success){
              this.messages = response.data.messages;
              if (this.isScrolledDown){
                this.$nextTick(() => {
                this.scrollToBottom();
              });
              this.isScrolledDown = false;
              }
              
            }
            else{
              this.messages = [];
            }
          })
          .catch(error => {
            console.error('Error fetching messages:', error);
          });
    },
    sendMessage() {
      let data = new FormData();
      let sessionId = sessionStorage.getItem('sessionId');
      data.append('sessionId', sessionId);
      data.append('message', this.newMessage);
      axios.post('http://localhost/php/Social-Media-Clone/src/back/messengerApi.php?action=sendMessage', data)
          .then(response => {
            console.log(response.data);
            if (response.data.success) {
              this.isScrolledDown = true;
              this.fetchMessages();
              this.newMessage = '';
            }
          })
          .catch(error => {
            console.error('Error sending message:', error);
          });
    },
    isSender(fromName) {
      return fromName === this.currentUser;
    },
    isConsecutive(fromName, index) {
      if (index > 0) {
        const previousMessage = this.messages[index - 1];
        return fromName === previousMessage.from_name;
      }
      return false;
    },
    scrollToBottom() {
      this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
    }
  },
  mounted() {
    this.fetchInterval = setInterval(() => {
      this.fetchMessages();
    }, 500);
    let data = new FormData();
    let sessionId = sessionStorage.getItem('sessionId');
    data.append('sessionId', sessionId);
    axios.post('http://localhost/php/Social-Media-Clone/src/back/messengerApi.php?action=getCurrentUserName', data)
    .then(response => {
      console.log(response.data);
      if (response.data.success) {
        this.currentUser = response.data.username;
        
      }
    })
    .catch(error => {
      console.error('Error sending message:', error);
    });
    
  },
  beforeUnmount() {
    clearInterval(this.fetchInterval);
  }
};
</script>
