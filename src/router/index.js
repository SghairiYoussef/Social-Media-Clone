import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '../views/Sign-inSign-up.vue';
import Homepage from '../views/Homepage.vue';

const routes = [
  {
    path: '/login',
    name: 'SigninSignup',
    component: SigninSignup
  },
  {
    path: '/Home',
    name: 'Home',
    component: Homepage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;