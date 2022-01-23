<script setup>
import { defineProps, ref } from 'vue';
import LikePhotosModal from './LikePhotosModal';
defineProps({
  user: {
    id: null,
    likePhotos: [],
    name: '',
    photos: [],
  },
  page: {
    type: Number,
    required: false,
  },
});
const showLikePhotosModal = ref(false);
const onClickShowModal = () => {
  console.log(showLikePhotosModal.value);
  showLikePhotosModal.value = true;
};
const onClickCloseModal = () => {
  showLikePhotosModal.value = false;
};
</script>

<template>
  <ul>
    <li>
      <router-link
        :to="`/users/${user.id}`"
        class="user-name"
      >
        {{ user.name }}
      </router-link>
    </li>
    <li>フォト投稿数: {{ user.photos.length }}</li>
    <li
      @click="onClickShowModal"
      data-toggle="photosModal"
      data-target="#photosModal"
    >
      <button>いいねしたフォト</button>
    </li>
  </ul>
  <LikePhotosModal
    :userName="user.name"
    :likePhotos="user.likePhotos"
    :closeModal="onClickCloseModal"
    v-show="showLikePhotosModal"
  />
</template>

<style>
.user-name {
  font-weight: bold;
  text-decoration: none;
}
ul {
  list-style: none;
}
</style>
