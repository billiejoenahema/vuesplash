<script setup>
import axios from 'axios';
import { defineEmits, ref } from 'vue';
import router from '../router';
import { store } from '../store';
import Loader from './Loader.vue';

const emit = defineEmits(['update']);

const preview = ref(null);
const photo = ref(null);
const loading = ref(false);

const onFileChange = (event) => {
  if (event.target.files.length === 0) {
    resetPreview();
    return;
  }
  if (!event.target.files[0].type.match('image.*')) {
    resetPreview();
    return;
  }
  const reader = new FileReader();
  reader.onload = (e) => {
    preview.value = e.target.result;
  };
  reader.readAsDataURL(event.target.files[0]);
  photo.value = event.target.files[0];
};

const resetPreview = () => {
  preview.value = '';
  photo.value = '';
};

const uploadFile = async () => {
  loading.value = true;
  const formData = new FormData();
  formData.append('photo', photo.value);
  await axios
    .post('/api/photos', formData)
    .then((res) => {
      console.log(res);
      emit('update:showForm', false);
      resetPreview();
      router.push(`/photos/${res.data.id}`);
      store.commit('toast/setContent', {
        content: '写真が投稿されました！',
        timeout: 6000,
      });
    })
    .catch((err) => {
      console.log(err);
    });
  loading.value = false;
};
</script>

<template>
  <div class="photo-form">
    <h2 class="title">Submit a photo</h2>
    <div v-show="loading" class="panel">
      <Loader>Sending your photo...</Loader>
    </div>
    <form
      v-show="!loading"
      class="form"
      @submit.prevent="uploadFile"
    >
      <input
        class="form__item"
        type="file"
        @change="onFileChange"
      />
      <output class="form__output" v-if="preview">
        <img :src="preview" alt="" />
      </output>
      <div class="form__button">
        <button
          type="button"
          class="button button--inverse"
          @click="uploadFile"
        >
          submit
        </button>
      </div>
    </form>
  </div>
</template>
