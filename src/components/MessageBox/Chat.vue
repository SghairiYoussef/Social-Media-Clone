<template>
    <header>
        <img src="https://via.placeholder.com/150" alt="Receiver Image" style="width:50px;" class="rounded-pill">
        <h1>{{ Receiver.name }}</h1>
    </header>
    <div>
        <div class="chat-messages">
            <ul class="message" v-for="(message,index) in sortedMessages()" :key="index">
                <li v-if="message.senderId=Receiver.id" class="message_received">
                        <p>{{ message.message }}</p>
                        <span>{{ message.time }}</span>
                </li>
                <li v-else class="message_sent">
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
</template>

<script>
export default {
    data() {
        return {
            new_message: {
                message: '',
                time: '',
                senderId: '',
                receiverId: ''
            },
            Receiver: {
                id: 2,
                name: 'User 2',
                messages: [
                    {
                        message: 'Hello',
                        time: '12:00',
                        senderId: 1,
                        receiverId: 2
                    },
                    {
                        message: 'Hi',
                        time: '12:01',
                        senderId: 2,
                        receiverId: 1
                    }
                ],
            }
        };
    },
    methods: {
        sendMessage() {
            if (this.new_message.message.trim() !== '') {
                this.new_message.receiver = this.Receiver.id;
                this.new_message.sender = 1;
                this.Receiver.messages.push(this.new_message);
                this.new_message = {
                    message: '',
                    time: '',
                    senderId: '',
                    receiverId: ''
                };
            }
        },
        sortedMessages() {
            this.Receiver.messages.sort((a, b) => {
                return a.time - b.time;
            });
            return this.Receiver.messages;
        }
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