<script setup>
import { computed, defineProps } from 'vue';
import { useStore } from 'vuex';
import PhotoItem from '../components/PhotoItem';

const store = useStore();
const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

store.dispatch('user/getUser', props.id);
const user = computed(() => store.getters['user/user']);
</script>
<template>
  <div>User Page</div>
  <div>{{ user.name }}</div>
  <div class="photo-list">
    <div class="grid">
      <PhotoItem
        class="grid__item"
        v-for="photo in user.photos"
        :key="photo.id"
        :item="photo"
        @like="onLikeClick"
      />
    </div>
  </div>
</template>
