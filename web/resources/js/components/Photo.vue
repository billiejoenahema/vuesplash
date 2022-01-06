<script setup>
import { defineEmits, defineProps } from 'vue';
const props = defineProps({
  item: Object,
});

const emit = defineEmits(['like']);

const like = () => {
  emit('like', {
    id: props.item.id,
    liked: props.item.liked_by_user,
  });
};
</script>

<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :src="item.url"
        :alt="`Photo by ${item.user.name}`"
      />
    </figure>
    <router-link
      class="photo__overlay"
      :to="`/photos/${props.item.id}`"
      :title="`View the photo by ${item.user.name}`"
    >
      <div class="photo__controls">
        <button
          :class="{
            'photo__action--liked': item.liked_by_user,
          }"
          title="Like photo"
          @click.prevent="like"
        >
          <i class="icon ion-md-heart"></i
          >{{ item.likeUsers.length }}
        </button>
        <a
          class="photo__action"
          title="Download photo"
          @click.stop
          :href="`/photos/${props.item.id}/download`"
        >
          <i class="icon ion-md-arrow-round-down"></i>
        </a>
      </div>
      <div class="photo__username">
        {{ props.item.user.name }}
      </div>
    </router-link>
  </div>
</template>
