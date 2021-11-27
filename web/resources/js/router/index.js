import { createRouter, createWebHistory } from 'vue-router';
import PhotoList from '../pages/PhotoList';
import UserLogin from '../pages/UserLogin';
import SystemError from '../pages/errors/SystemError.vue';

const routes = [
  {
    path: '/',
    component: PhotoList,
  },
  {
    path: '/login',
    component: UserLogin,
  },
  {
    path: '/500',
    component: SystemError,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
