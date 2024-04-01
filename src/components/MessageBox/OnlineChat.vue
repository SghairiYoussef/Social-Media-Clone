<template>
    <div class="chat-container">
      <div class="messages-container">
        <div v-for="(message, index) in messages" :key="index" class="message">
          <div class="message-sender">{{ message.from_name }}</div>
          <div class="message-content">{{ message.message }}</div>
        </div>
      </div>
      <div class="new-message-container">
        <textarea v-model="newMessage" class="form-control" rows="3" placeholder="Type your message..."></textarea>
        <button @click="sendMessage" class="btn btn-primary">Send</button>
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
        newMessage: ''
      };
    },
    watch: {
      selectedUser: {
        immediate: true,
        handler(newVal, oldVal) {
          if (newVal !== oldVal) {
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
          }
        })
        .catch(error => {
          console.error('Error fetching messages:', error);
        });
      },
      sendMessage() {
        // Send the new message to the selected user
      }

    }
  };
  </script>
  
  <style scoped>
  .chat-container {
    display: flex;
    flex-direction: column;
  }
  
  .messages-container {
    flex: 1;
    overflow-y: auto;
    padding: 10px;
  }
  
  .message {
    margin-bottom: 10px;
  }
  
  .message-sender {
    font-weight: bold;
  }
  
  .new-message-container {
    display: flex;
    margin-top: 10px;
  }
  
  .new-message-container textarea {
    flex: 1;
    margin-right: 10px;
  }
  </style>
  