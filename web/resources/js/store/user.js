import axios from 'axios';

const state = {
  errors: '',
  data: '',
  user: '',
  users: '',
};

const getters = {
  data: (state) => {
    return state.data;
  },
  user: (state) => {
    return state.user;
  },
  users: (state) => {
    return state.data?.data;
  },
  userCount: (state) => {
    return state.data.meta?.total;
  },
  currentPage: (state) => {
    return state.data.meta?.current_page;
  },
  lastPage: (state) => {
    return state.data.meta?.last_page;
  },
};

const actions = {
  async post({ commit }, formData) {
    await axios
      .post('/api/users', formData)
      .then((res) => {
        commit('setUser', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async getUser({ commit }, id) {
    await axios
      .get(`/api/users/${id}`)
      .then((res) => {
        console.log(res.data);
        commit('setUser', res.data.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async getUsers({ commit }, page) {
    await axios
      .get(`/api/users/?page=${page}`)
      .then((res) => {
        commit('setData', res.data);
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
  setData(state, data) {
    state.data = data;
  },
  setUser(state, user) {
    state.user = user;
  },
  setUsers(state, users) {
    state.users = users;
  },
};

export default {
  actions,
  getters,
  mutations,
  namespaced: true,
  state,
};
