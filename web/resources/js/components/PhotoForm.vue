<script setup>
import axios from 'axios';
import { defineEmits, ref } from 'vue';
import router from '../router';

const emit = defineEmits(['update']);

const preview = ref(null);
const photo = ref(null);

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
};

const uploadFile = async () => {
  const formData = new FormData();
  formData.append('photo', photo.value);
  console.log(photo.value);
  await axios
    .post('/api/photos', formData)
    .then((res) => {
      console.log(res);
      emit('update:showForm', false);
      router.push(`/photos/${res.data.id}`);
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>

<template>
  <div class="photo-form">
    <h2 class="title">Submit a photo</h2>
    <form class="form" @submit.prevent="uploadFile">
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
