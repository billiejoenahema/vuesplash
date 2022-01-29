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
      <li>
        フォト投稿数
        <span class="badge badge-secondary">{{
          user.photos.length
        }}</span>
      </li>
      <li @click="onClickShowModal" class="clickable">
        いいねしたフォト
        <span class="badge badge-secondary">{{
          user.likePhotos.length
        }}</span>
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
.clickable {
  cursor: pointer;
}
.user-item {
  border: 1px solid rgb(126, 126, 126);
  border-radius: 4px;
  padding: 1rem;
  margin: 1rem 0 0 0;
}
.badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out,
    background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out,
    box-shadow 0.15s ease-in-out;
}
.badge-secondary {
  color: #fff;
  background-color: #6c757d;
}
</style>
