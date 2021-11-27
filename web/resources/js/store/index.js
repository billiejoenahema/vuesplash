import { createStore } from 'vuex';

import auth from './auth';
import error from './error';

export const store = createStore({
  modules: {
    auth,
    error,
  },
});
