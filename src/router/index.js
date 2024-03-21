import { createRouter, createWebHistory } from 'vue-router';
import SigninSignup from '../views/Sign-inSign-up.vue';

const routes = [
  {
    path: '/',
    component: SigninSignup
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;