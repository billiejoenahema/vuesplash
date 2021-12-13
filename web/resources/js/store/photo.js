import axios from 'axios';

const state = {
  errors: '',
  photo: '',
  photos: '',
};

const getters = {
  photo: (state) => {
    return state.content;
  },
  photos: (state) => {
    return state.content;
  },
};

const actions = {
  async post({ commit }, formData) {
    console.log('formData');
    console.log(formData);
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
  async getPhotos({ commit }, param) {
    await axios
      .get('/api/photos', param)
      .then((res) => {
        commit('setPhotos', res.data);
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
