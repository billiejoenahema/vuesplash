<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';
import { alertLogin } from '../functions/alertLogin';

const store = useStore();
const props = defineProps({
  photo: {
    id: null,
    like_users_count: null,
    liked_by_user: false,
    url: '',
    comments: [],
    likeUsers: [],
    user: [],
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
      store.dispatch('user/getUsers');
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
    <ion-icon
      :name="
        photo.liked_by_user ? 'heart' : 'heart-outline'
      "
    />{{ photo.like_users_count ?? photo.likeUsers.length }}
  </button>
</template>
