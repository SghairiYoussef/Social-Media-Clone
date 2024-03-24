import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '@/views/Sign-inSign-up.vue';
import HomePage from '@/views/HomePage.vue';
import VerifyEmail from '@/views/VerifyEmail.vue';
import ForgotPassword from '@/views/ForgotPassword.vue';

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
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;