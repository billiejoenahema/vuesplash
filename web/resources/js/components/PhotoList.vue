<script setup>
import { computed } from 'vue';
import Photo from '../components/Photo.vue';
import { useStore } from 'vuex';

const store = useStore();

store.dispatch('photo.photos', 'get');
const photos = computed(
  () => store.getters['photo/photos']
);
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
