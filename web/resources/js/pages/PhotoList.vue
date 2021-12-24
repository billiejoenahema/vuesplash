<script setup>
import {
  computed,
  defineProps,
  reactive,
  watchEffect,
} from 'vue';
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

const dateList = reactive([
  { date: '1月1日' },
  { date: '1月2日' },
  { date: '1月2日' },
  { date: '1月3日' },
  { date: '1月3日' },
  { date: '1月4日' },
]);

const current = {
  date: '',
};
// メッセージの日付表示を制御
const showDate = (date) => {
  if (current.date !== date) {
    current.date = date;
    return true;
  } else {
    return false;
  }
};
</script>

<template>
  <div v-for="(message, index) in dateList" :key="index">
    // メッセージの日付
    <div v-show="showDate(message.date)">
      {{ message.date }}
    </div>
    <div>message body</div>
  </div>
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
