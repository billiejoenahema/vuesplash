<script setup>
import { defineProps } from 'vue';
import LikeButton from './LikeButton.vue';
const props = defineProps({
  photo: Object,
  isLogin: Boolean,
  page: {
    type: Number,
    required: false,
  },
});
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
      :to="`/photos/${props.photo.id}`"
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
          :href="`/photos/${props.photo.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
      </div>
      <div class="photo__username">
        {{ props.photo.user.name }}
      </div>
    </router-link>
  </div>
</template>
