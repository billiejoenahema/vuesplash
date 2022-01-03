import { createStore } from 'vuex';

import auth from './auth';
import error from './error';
import like from './like';
import photo from './photo';
import toast from './toast';

export const store = createStore({
  modules: {
    auth,
    error,
    like,
    photo,
    toast,
  },
});
