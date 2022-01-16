<script setup>
import { computed, defineProps, watchEffect } from 'vue';
import { useStore } from 'vuex';
import PhotoItem from '../components/PhotoItem';
import ThePagination from '../components/ThePagination';

const store = useStore();
const props = defineProps({
  page: {
    type: Number,
    required: false,
    default: 1,
  },
});

store.dispatch('auth/loginUser');
const isLogin = computed(
  () => store.getters['auth/isLogin']
);

store.dispatch('photo/getPhotos', props.page);
const photos = computed(
  () => store.getters['photo/photos']
);

const photoCount = computed(
  () => store.getters['photo/photoCount']
);

const currentPage = computed(
  () => store.getters['photo/currentPage']
);
const lastPage = computed(
  () => store.getters['photo/lastPage']
);

watchEffect(() => {
  store.dispatch('photo/getPhotos', props.page);
});
</script>

<template>
  <div>フォト投稿数: {{ photoCount }}</div>
  <div class="photo-list">
    <div class="grid">
      <PhotoItem
        class="grid__item"
        v-for="photo in photos"
        :key="photo.id"
        :photo="photo"
        :isLogin="isLogin"
        :page="page"
      />
    </div>
    <ThePagination
      :current-page="currentPage"
      :last-page="lastPage"
    />
  </div>
</template>
