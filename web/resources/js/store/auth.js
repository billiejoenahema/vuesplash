/* eslint-disable no-undef */
const state = {
  user: {},
  errors: [],
};

const getters = {
  hasErrors(state) {
    return state?.errors.length ?? 0;
  },
};

const actions = {
  async register({ commit }, data) {
    await axios
      .post('/api/register', data)
      .then((res) => {
        commit('setUser', res.config.data);
      })
      .catch((err) => {
        commit('setError', err);
      });
  },
  async login({ commit }, data) {
    await axios
      .post('/api/login', data)
      .then((res) => {
        commit('setUser', res.config.data);
      })
      .catch((err) => {
        commit('setError', err);
      });
  },
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setError(state, error) {
    state.errors = [...state.errors, error];
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
