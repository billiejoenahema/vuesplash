/* eslint-disable no-undef */
const state = {
  user: '',
  errors: null,
};

const getters = {
  hasErrors(state) {
    return state.errors ?? [];
  },
};

const actions = {
  async register({ commit }, data) {
    await axios
      .post('/api/register', data)
      .then((res) => {
        console.log(res.status);
        commit('setUser', res.data);
      })
      .catch((err) => {
        console.error(err);
        commit('setError', err);
      });
  },
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },
  setError(state, error) {
    state.user = error;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions,
};
