import { createRouter, createWebHistory } from 'vue-router';
import PhotoList from '../pages/PhotoList';
import Login from '../pages/Login';

const routes = [
  {
    path: '/',
    component: PhotoList,
  },
  {
    path: '/login',
    component: Login,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
