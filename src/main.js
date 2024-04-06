import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

import './assets/css/bootstrap.min.css';
import './assets/css/responsive.css';
import './assets/css/authentication.css';
import './assets/css/verifyEmail.css';
import './assets/css/forgotPassword.css';
import './assets/css/homepage.css';
import './assets/css/myaccount.css';
import './assets/css/passwordReset.css';
import './assets/css/EditProfile.css';
import '@fortawesome/fontawesome-free/css/all.css';
import './assets/css/onlineChat.css';

import axios from 'axios';


const app = createApp(App);


async function sendDataOnTabClose() {
    try {
        const sessionId = sessionStorage.getItem('sessionId');
        if (sessionId) {
            const data = new FormData();
            data.append('sessionId', sessionId);
            await axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=setOffline`, data);
            console.log('User is offline');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}


window.addEventListener('beforeunload', sendDataOnTabClose);

app.use(router);
app.use(store);
app.mount('#app');