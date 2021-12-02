<script setup>
import { ref } from 'vue';
const preview = ref(null);

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
    console.log(preview.value);
  };
  reader.readAsDataURL(event.target.files[0]);
};

const resetPreview = () => {
  preview.value = '';
};
</script>

<template>
  <div class="photo-form">
    <h2 class="title">Submit a photo</h2>
    <form class="form">
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
          type="submit"
          class="button button--inverse"
        >
          submit
        </button>
      </div>
    </form>
  </div>
</template>
