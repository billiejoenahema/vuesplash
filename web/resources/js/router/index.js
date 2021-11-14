import { createRouter, createWebHistory } from 'vue-router';
import PhotoList from '../pages/PhotoList';
import UserLogin from '../pages/UserLogin';

const routes = [
  {
    path: '/',
    component: PhotoList,
  },
  {
    path: '/login',
    component: UserLogin,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
