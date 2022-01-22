<script setup>
import { computed, defineProps } from 'vue';
import { useStore } from 'vuex';
import LikeButton from './LikeButton.vue';

defineProps({
  photo: {
    id: null,
    url: '',
    user: {},
  },
  page: {
    type: Number,
    required: false,
  },
});
const store = useStore();
const isLogin = computed(
  () => store.getters['auth/isLogin']
);
</script>

<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :src="photo.url"
        :alt="`Photo by ${photo.user.name}`"
      />
    </figure>
    <router-link
      class="photo__overlay"
      :to="`/photos/${photo.id}`"
      :title="`View the photo by ${photo.user.name}`"
    >
      <div class="photo__controls">
        <LikeButton
          :photo="photo"
          :isLogin="isLogin"
          :page="page"
        />
        <a
          class="photo__action"
          title="Download photo"
          @click.stop
          :href="`/photos/${photo.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
      </div>
      <div class="photo__username">
        {{ photo.user.name }}
      </div>
    </router-link>
  </div>
</template>
