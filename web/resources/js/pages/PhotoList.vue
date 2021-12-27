<script setup>
import {
  computed,
  defineProps,
  onMounted,
  watchEffect,
} from 'vue';
import { useStore } from 'vuex';
import router from '../router';
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

const isLogin = computed(
  () => store.getters['auth/isLogin']
);
onMounted(() => {
  if (!isLogin.value) {
    router.push('/login');
  }
});

const currentPage = computed(
  () => store.getters['photo/currentPage']
);
const lastPage = computed(
  () => store.getters['photo/lastPage']
);

store.dispatch('photo/getPhotos', props.page);
const photos = computed(
  () => store.getters['photo/photos']
);

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
      />
    </div>
    <Pagination
      :current-page="currentPage"
      :last-page="lastPage"
    />
  </div>
</template>
