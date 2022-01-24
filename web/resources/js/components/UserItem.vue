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
  <div class="user-item">
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
      v-show="showLikePhotosModal"
      :userName="user.name"
      :likePhotos="user.likePhotos"
      :closeModal="onClickCloseModal"
    />
  </div>
</template>

<style>
.user-name {
  font-weight: bold;
  text-decoration: none;
}
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
.user-item {
  border: 1px solid rgb(126, 126, 126);
  border-radius: 4px;
  padding: 1rem;
}
</style>
