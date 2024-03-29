import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '@/views/Sign-inSign-up.vue';
import HomePage from '@/views/HomePage.vue';
import VerifyEmail from '@/views/VerifyEmail.vue';
import ForgotPassword from '@/views/ForgotPassword.vue';
import MyAccountPage from '@/views/MyAccountPage.vue';
import PasswordReset from '@/views/PasswordReset.vue';
import Contact from '@/views/Contact.vue';
import Messages from '@/views/Messages.vue';
import Admin from '@/views/Admin.vue';
const routes = [
  {
    path: '/login',
    name: 'SigninSignup',
    component: SigninSignup
  },
  {
    path: '/Home',
    name: 'Home',
    component: HomePage
  },
  {
    path: '/',
    redirect: '/login'
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
    component: MyAccountPage
  },
  {
    path: '/login/passwordReset/:resetPasswordToken',
    name: 'PasswordReset',
    component: PasswordReset
  },
  {
    path: '/Contact',
    name: 'Contact',
    component: Contact
  },
  {
    path: '/Messages',
    name: 'Messages',
    component: Messages
  },
  {
    path: '/Admin',
    name: 'Admin',
    component: Admin
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;