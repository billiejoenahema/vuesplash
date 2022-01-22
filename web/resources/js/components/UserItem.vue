<script setup>
import { defineProps } from 'vue';
import LikePhotosModal from './LikePhotosModal.vue';
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
</script>

<template>
  <div>
    <router-link
      :to="`/users/${user.id}`"
      class="user-name"
    >
      {{ user.name }}
    </router-link>
    <div>フォト投稿数: {{ user.photos.length }}</div>
    <div>いいねしたフォト(モーダルで表示させる)</div>
    <LikePhotosModal :likePhotos="user.likePhotos" />
  </div>
</template>

<style>
.user-name {
  font-weight: bold;
  text-decoration: none;
}
</style>
