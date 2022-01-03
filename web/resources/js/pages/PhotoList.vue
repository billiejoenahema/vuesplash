<script setup>
import { computed, defineProps, watchEffect } from 'vue';
import { useStore } from 'vuex';
import Photo from '../components/Photo';
import Pagination from '../components/Pagination';

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

const currentPage = computed(
  () => store.getters['photo/currentPage']
);
const lastPage = computed(
  () => store.getters['photo/lastPage']
);

const onLikeClick = ({ id, liked }) => {
  if (!isLogin.value) {
    alert('いいね機能を使うにはログインしてください。');
    return;
  }
  if (liked) {
    store.dispatch('like/delete', id);
  } else {
    store.dispatch('like/put', id);
  }
};

watchEffect(() => {
  store.dispatch('photo/getPhotos', props.page);
});
</script>

<template>
  <div class="photo-list">
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="photo in photos"
        :key="photo.id"
        :item="photo"
        @like="onLikeClick"
      />
    </div>
    <Pagination
      :current-page="currentPage"
      :last-page="lastPage"
    />
  </div>
</template>
