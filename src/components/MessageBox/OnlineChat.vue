<template>
  <div class="chat-container">
    <div class="messages-container">
      <div v-for="(message, index) in messages" :key="index" :class="{ 'sender-message': isSender(message.from_name, index), 'receiver-message': !isSender(message.from_name, index) }" :style="{ 'background-color': isSender(message.from_name, index) ? '#007bff' : '#f0f0f0' }" class="message">
        <div v-if="!isConsecutiveSender(message.from_name, index)" class="message-sender">{{ message.from_name }}</div>
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
      newMessage: '',
      currentUser: ''
    };
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
              this.fetchMessages();
              this.newMessage = '';
            }
          })
          .catch(error => {
            console.error('Error sending message:', error);
          });
    },
    isSender(fromName, index) {
      return fromName === this.currentUser && (!index || fromName !== this.messages[index - 1].from_name);
    },
    isConsecutiveSender(fromName, index) {
      return fromName === this.currentUser && index && fromName === this.messages[index - 1].from_name;
    }
  },
  mounted() {
    setInterval(() => {
      this.fetchMessages();
    }, 500);

    // Set the current user's name
    this.currentUser = sessionStorage.getItem('currentUser');
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

.sender-message {
  align-self: flex-end; /* Align sender's messages to the right */
  color: #fff;
  border-radius: 5px;
  padding: 5px 10px;
  max-width: 70%;
}

.receiver-message {
  align-self: flex-start; /* Align receiver's messages to the left */
  color: #000;
  border-radius: 5px;
  padding: 5px 10px;
  max-width: 70%;
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
