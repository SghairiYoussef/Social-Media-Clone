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




const app = createApp(App);

// Listen for the beforeunload event to clear sessionStorage
/*window.addEventListener('beforeunload', function() {
    // Clear sessionStorage when the browser is closed
    sessionStorage.clear();
});
*/
app.use(router);
app.use(store);
app.mount('#app');