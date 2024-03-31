<template>
    <div>
        <header v-if="selectedUser">
            <img src="../../../public/img/noProfileImage.jpg" alt="Receiver Image" style="width:50px;" class="rounded-pill">
            <h1>{{ selectedUser.username }}</h1>
        </header>
        <div v-if="selectedUser">
            <div class="chat-messages">
                <ul class="message">
                    <li v-for="(message, index) in selectedUserMessages" :key="index" :class="message.senderName === currentUser.name ? 'message_sent' : 'message_received'">
                        <p>{{ message.message }}</p>
                        <span>{{ message.time }}</span>
                    </li>
                </ul>
            </div>
            <div class="input-group mb-3">
                <input type="text" v-model="new_message.message" placeholder="Type Your Message Here..." class="form-control">
                <button class="btn btn-primary" @click="sendMessage">Send</button>
            </div>
        </div>
        <div v-else>
            <p>No user selected</p>
        </div>
    </div>
</template>

<script>

export default {
    mounted() {
        // Fetch currentUser from session
    },
    props: ['selectedUser'],
    data() {
        return {
            new_message: {
                message: '',
                time: '',
                senderName: '',
                receiverName: ''
            },
            selectedUserMessages: []
        };
    },
    methods: {
        sendMessage() {
            if (this.new_message.message.trim() !== '') {
                const message = {
                    message: this.new_message.message,
                    time: new Date().toLocaleString(),
                    senderName: this.currentUser.name,
                    receiverName: this.selectedUser.username
                };
                this.selectedUserMessages.push(message);
                this.new_message.message = '';
            }
        },
    },
    name: 'ChatBox'
};
</script>

<style scoped>
    .message {
        list-style-type: none;
        padding: 0;
    }
    .message_sent {
        background-color: #294aef;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
        text-align: right;
    }
    .message_received{
        background-color: #f1f0f0;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
        text-align: left;
    }
</style>
