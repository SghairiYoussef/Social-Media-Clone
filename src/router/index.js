import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '../views/Sign-inSign-up.vue';
import HomePage from '../views/HomePage.vue';

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
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;