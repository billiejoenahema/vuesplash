<script setup>
import { defineEmits, ref } from 'vue';
import router from '../route';
import { useStore } from 'vuex';
import TheLoader from './TheLoader.vue';

const store = useStore();

const emit = defineEmits(['update:showForm']);

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
  formData.set('photo', photo.value);
  await store.dispatch('photo/post', formData);
  photo.value = store.getters['photo/photo'];
  emit('update:showForm', false);
  router.push(`/photos/${photo.value.id}`);
  store.commit('toast/setContent', {
    content: '写真が投稿されました！',
    timeout: 6000,
  });
  resetPreview();
  loading.value = false;
};
</script>

<template>
  <div class="photo-form">
    <h2 class="title">Submit a photo</h2>
    <div v-show="loading" class="panel">
      <TheLoader>Sending your photo...</TheLoader>
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
