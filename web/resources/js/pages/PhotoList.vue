<script setup>
import { computed, onMounted } from 'vue';
import Photo from '../components/Photo.vue';
import { useStore } from 'vuex';

const store = useStore();

store.dispatch('photo/getPhotos');
const photos = computed(
  () => store.getters['photo/photos']
);
onMounted(() => {
  console.log(photos.value);
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
  </div>
</template>
