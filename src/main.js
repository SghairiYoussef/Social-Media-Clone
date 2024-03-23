import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import './assets/css/bootstrap.min.css';
import './assets/css/responsive.css';
import './assets/css/authentication.css';
import './assets/css/verifyEmail.css';



createApp(App).use(router).mount('#app');