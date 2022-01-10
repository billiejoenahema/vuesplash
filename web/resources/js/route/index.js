import { createRouter, createWebHistory } from 'vue-router';
import NotFound from '../pages/errors/NotFound';
import PhotoDetail from '../pages/PhotoDetail.vue';
import PhotoList from '../pages/PhotoList';
import SystemError from '../pages/errors/SystemError.vue';
import UserDetail from '../pages/UserDetail.vue';
import UserLogin from '../pages/UserLogin';

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
    path: '/users/:id',
    component: UserDetail,
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
  {
    path: '/:catchAll(.*)',
    component: NotFound,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes: routes,
  scrollBehavior() {
    return { x: 0, y: 0 };
  },
});

export default router;
