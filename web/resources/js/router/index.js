import { createRouter, createWebHistory } from 'vue-router';
import PhotoList from '../pages/PhotoList';
import UserLogin from '../pages/UserLogin';
import SystemError from '../pages/errors/SystemError.vue';
import PhotoDetail from '../components/PhotoDetail.vue';

const routes = [
  {
    path: '/',
    component: PhotoList,
    props: (route) => {
      const page = route.query.page;
      return {
        page: /^[1-9][0-9]*$/.test(page) ? page * 1 : 1,
      };
    },
  },
  {
    path: '/photos/:id',
    component: PhotoDetail,
    props: true,
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
