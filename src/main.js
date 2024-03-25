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

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');