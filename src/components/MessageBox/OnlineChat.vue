<template>
    <div class="chat-container">
      <div class="messages-container">
        <div v-for="(message, index) in messages" :key="index" class="message">
          <div class="message-sender">{{ message.sender }}</div>
          <div class="message-content">{{ message.content }}</div>
        </div>
      </div>
      <div class="new-message-container">
        <textarea v-model="newMessage" class="form-control" rows="3" placeholder="Type your message..."></textarea>
        <button @click="sendMessage" class="btn btn-primary">Send</button>
      </div>
    </div>
  </template>
  
  <script>

  export default {
    props: {
      selectedUser: {
        type: Object,
        required: true
      }
    },
    data() {
      return {
        messages: [
          { sender: 'Yassine', content: 'Hello!' },
          { sender: 'Yassine', content: 'Hi there!' }
        ],
        newMessage: ''
      };
    },
    mounted() {
      this.fetchMessages();
    },
    methods: {
      fetchMessages() {
        // fetch messages from database where sender = selectedUser.username
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
  