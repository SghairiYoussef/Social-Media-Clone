import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '@/views/Sign-inSign-up.vue';
import HomePage from '@/views/HomePage.vue';
import VerifyEmail from '@/views/VerifyEmail.vue';
import ForgotPassword from '@/views/ForgotPassword.vue';
import MyAccountPage from '@/views/MyAccountPage.vue';
import PasswordReset from '@/views/PasswordReset.vue';
import Contact from '@/views/Contact.vue';
import Messages from '@/views/Messages.vue';
import EditProfile from '@/views/EditProfile.vue';
import Admin from '@/views/Admin.vue';
import WelcomePage from '@/views/WelcomePage.vue';
import UserAccount from '@/views/UserAccount.vue';
import axios from "axios";

const routes = [
  {
    path: '/login',
    name: 'SigninSignup',
    component: SigninSignup
  },
  {
    path: '/Home',
    name: 'Home',
    component: HomePage,
    meta: {
        requiresAuth: true
    }
  },
  {
    path: '/',
    redirect: '/Admin'
  },
  {
    path: '/login/verifyEmail',
    name: 'VerifyEmail',
    component: VerifyEmail
  },
  {
    path: '/login/forgotPassword',
    name: 'ForgotPassword',
    component: ForgotPassword
  },
  {
    path: '/myAccount',
    name: 'MyAccountPage',
    component: MyAccountPage,
    meta: {
        requiresAuth: true
    }
  },
  {
    path: '/login/passwordReset/:resetPasswordToken',
    name: 'PasswordReset',
    component: PasswordReset
  },
  {
    path: '/Contact',
    name: 'Contact',
    component: Contact,
    },
  {
    path: '/Messages',
    name: 'Messages',
    component: Messages,
    meta: {
        requiresAuth: true
    }
  },
  {
    path: '/profile',
    name: 'profile',
    component: UserAccount,
    meta: {
        requiresAuth: true
    }
  },
  {
    path: '/EditProfile',
    name: 'EditProfile',
    component: EditProfile,
    meta: {
        requiresAuth: true
    }
  },
  {
    path: '/Admin',
    name: 'Admin',
    component: Admin,
    meta: {
      requiresAuth: true,
      isAdmin : true
    }
  },
  {
    path: '/WelcomePage',
    name: 'WelcomePage',
    component: WelcomePage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});
router.beforeEach((to, from, next) => {
  // Perform the check if the route requires authentication
  if (to.meta.requiresAuth) {
    // Get the session ID from the session cookie
    const sessionId = sessionStorage.getItem('sessionId');
    let data =new FormData();
    if (sessionId !== null) {
      data.append('sessionId', sessionId);
    }
    axios.defaults.withCredentials = true;
    axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=isLoggedIn`,data)
        .then(response => {
          console.log(response.data.message);
          if (!response.data.success) {
            // If the user is not logged in, redirect to the login page
            next('/WelcomePage');
          } else {
            // If the user is logged in, continue with the navigation
            setUserOnline();
            sessionStorage.setItem('sessionId', response.data.sessionID);
            sessionStorage.setItem('userId', response.data.userId);
            if(to.meta.isAdmin && !response.data.isAdmin){
                next('/Home');
            }
            next();
          }
        })
        .catch(error => {
          console.error('Error checking authentication status:', error);
          // If there's an error, prevent navigation
          next(false);
        });


  } else {
    // If the route does not require authentication, continue with the navigation
    next();
  }
});
function setUserOnline() {
  try {
      const sessionId = sessionStorage.getItem('sessionId');
      if (sessionId) {
          const data = new FormData();
          data.append('sessionId', sessionId);
          axios.post(`http://localhost/php/Social-Media-Clone/src/back/api.php?action=setOnline`, data);
          console.log('User is online');
      }
  } catch (error) {
      console.error('Error:', error);
  }
}


export default router;