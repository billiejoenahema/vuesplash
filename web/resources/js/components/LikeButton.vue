<script setup>
import { computed, defineProps } from 'vue';
import { useStore } from 'vuex';
import { alertLogin } from '../functions/alertLogin';
import photo from '../store/photo';

const store = useStore();

const props = defineProps({
  photo: {
    type: Object,
    required: true,
  },
  isLogin: {
    type: Boolean,
    required: true,
  },
  page: {
    type: Number,
    required: false,
  },
});

const likeHasErrors = computed(
  () => store.getters['like/hasErrors']
);

const onLikeClick = async () => {
  alertLogin(props.isLogin);
  if (props.photo.liked_by_user) {
    await store.dispatch('like/delete', props.photo.id);
  } else {
    await store.dispatch('like/put', props.photo.id);
  }
  if (!likeHasErrors.value) {
    store.commit('toast/setContent', {
      content: props.photo.liked_by_user
        ? 'いいねを解除しました！'
        : 'いいねしました！',
      timeout: 4000,
    });
    if (props.page) {
      store.dispatch('photo/getPhotos', props.page);
    } else {
      store.dispatch('photo/getPhoto', props.photo.id);
    }
  }
};
</script>

<template>
  <button
    :class="{ 'button--liked': photo.liked_by_user }"
    title="Like photo"
    @click.prevent="onLikeClick"
  >
    <i class="icon ion-md-heart"></i
    >{{ photo.likeUsers.length }}
  </button>
</template>
