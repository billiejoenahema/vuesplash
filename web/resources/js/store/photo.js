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
    return state.data;
  },
  photos: (state) => {
    return state.data?.data;
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
        commit('setPhotos', res.data);
      })
      .catch((err) => {
        commit('setErrors', err);
      });
  },
  async getPhotos({ commit }) {
    await axios
      .get('/api/photos')
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
