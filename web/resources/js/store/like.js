import axios from 'axios';

const state = {
  errors: '',
  like: '',
};

const getters = {
  like: (state) => {
    return state.data;
  },
};

const actions = {
  async put({ commit }, id) {
    await axios
      .post(`/api/likes/${id}`)
      .then((res) => {
        commit('setLike', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async delete({ commit }, id) {
    await axios
      .post(`/api/likes/${id}`)
      .then((res) => {
        commit('setLike', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
};

const mutations = {
  setErrors(state, err) {
    state.errors = err;
  },
  setLike(state, data) {
    state.like = data;
  },
};

export default {
  actions,
  getters,
  mutations,
  namespaced: true,
  state,
};
