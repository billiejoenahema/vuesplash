<script setup>
import { defineEmits, defineProps } from 'vue';
const props = defineProps({
  item: Object,
});

const emit = defineEmits(['like']);

const like = () => {
  emit('like', props.item.id);
};
</script>

<template>
  <div class="photo">
    <figure class="photo__wrapper">
      <img
        class="photo__image"
        :src="props.item.url"
        :alt="`Photo by ${props.item.user.name}`"
      />
    </figure>
    <RouterLink
      class="photo__overlay"
      :to="`/photos/${props.item.id}`"
      :title="`View the photo by ${props.item.user.name}`"
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
          >{{ item.likes_count }}
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
    </RouterLink>
  </div>
</template>
