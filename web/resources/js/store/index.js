import { createStore } from 'vuex';

import auth from './auth';
import error from './error';
import toast from './toast';

export const store = createStore({
  modules: {
    auth,
    error,
    toast,
  },
});
