import axios from 'axios';

const state = {
  errors: '',
  data: '',
  photo: '',
  photos: '',
};

const getters = {
  data: (state) => {
    return state.data;
  },
  photo: (state) => {
    return state.photo;
  },
  photos: (state) => {
    return state.data?.data;
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
      .post('/api/photos', formData)
      .then((res) => {
        commit('setPhoto', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async getPhoto({ commit }, id) {
    await axios
      .get(`/api/photos/${id}`)
      .then((res) => {
        commit('setPhoto', res.data.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async getPhotos({ commit }, page) {
    await axios
      .get(`/api/photos/?page=${page}`)
      .then((res) => {
        commit('setData', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async postComment({ commit }, { photoId, content }) {
    await axios
      .post(`/api/comments/${photoId}`, {
        content: content,
      })
      .then((res) => {
        console.log(res);
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
  setPhoto(state, photo) {
    state.photo = photo;
  },
  setPhotos(state, photos) {
    state.photos = photos;
  },
};

export default {
  actions,
  getters,
  mutations,
  namespaced: true,
  state,
};
