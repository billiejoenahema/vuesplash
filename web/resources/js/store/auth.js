/* eslint-disable no-undef */
const state = {
  user: {},
  login_user: {},
  errors: [],
};

const getters = {
  isLogin(state) {
    if (state.user) {
      return Object.keys(state.user).length !== 0;
    }
    return false;
  },
  userName(state) {
    return state.user?.name ?? '';
  },
  errors(state) {
    return state?.errors ?? [];
  },
  hasErrors(state) {
    return state?.errors.length ?? 0;
  },
};

const actions = {
  async register({ commit }, data) {
    await axios
      .post('/api/register', data)
      .then((res) => {
        console.log(res.status);
      })
      .catch((err) => {
        state.errors;
        commit('setError', err);
      });
  },
  async login({ commit }, data) {
    await axios
      .post('/api/login', data)
      .then((res) => {
        console.log(res.status);
        commit('setUser', res.data);
        commit('reSetError', []);
      })
      .catch((err) => {
        commit('setError', err);
      });
  },
  async logout({ commit }) {
    await axios.post('/api/logout');
    commit('setUser', {});
  },
  async loginUser({ commit }) {
    await axios.get('api/login_user').then((res) => {
      commit('setUser', res.data.login_user);
    });
  },
};

const mutations = {
  setUser(state, login_user) {
    state.user = login_user;
  },
  setError(state, error) {
    state.errors = [error];
  },
  reSetError(state, defaultError) {
    state.errors = defaultError;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
