<script setup>
import { computed, ref } from 'vue';
import { useStore } from 'vuex';
import LikeButton from '../components/LikeButton';

import router from '../route';

const store = useStore();
const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

const isLogin = computed(
  () => store.getters['auth/isLogin']
);
const loginUser = computed(
  () => store.getters['auth/loginUser']
);
store.dispatch('photo/getPhoto', props.id);
const photo = computed(() => store.getters['photo/photo']);

const photoHasErrors = computed(
  () => store.getters['like/hasErrors']
);
const fullWidth = ref(false);
const newComment = ref('');
const postComment = async () => {
  await store.dispatch('photo/postComment', {
    photoId: props.id,
    content: newComment.value,
  });
  newComment.value = '';
  store.dispatch('photo/getPhoto', props.id);
};

const deletePhoto = async () => {
  if (!isLogin.value) {
    return;
  }
  await store.dispatch('photo/delete', props.id);
  if (!photoHasErrors.value) {
    router.push('/');
  }
};
</script>

<template>
  <div
    v-if="photo"
    class="photo-detail"
    :class="{ 'photo-detail--column': fullWidth }"
  >
    <figure
      class="photo-detail__pane photo-detail__image"
      @click="fullWidth = !fullWidth"
    >
      <img :src="photo.url" alt="" />
    </figure>
    <figcaption>
      Posted by
      <router-link
        class="user-name"
        :to="`/users/${photo.user.id}`"
      >
        {{ photo.user.name }}
      </router-link>
    </figcaption>
    <div class="photo-detail__pane">
      <div
        class="form__button"
        v-show="loginUser.id === photo.user.id"
      >
        <button type="submit" @click="deletePhoto">
          削除
        </button>
      </div>
      <LikeButton :photo="photo" :isLogin="isLogin" />
      <a
        :href="`/photos/${photo.id}/download`"
        class="button"
        title="Download photo"
      >
        <i class="icon ion-md-arrow-round-down"></i>Download
      </a>
      <h2 class="photo-detail__title">
        <i class="icon ion-md-chatboxes"></i>Comments
      </h2>
      <ul
        v-if="photo.comments.length > 0"
        class="photo-detail__comments"
      >
        <li
          v-for="comment in photo.comments"
          :key="comment.id"
          class="photo-detail__commentItem"
        >
          <p class="photo-detail__commentBody">
            {{ comment.content }}
          </p>
          <p class="photo-detail__commentInfo">
            {{ comment.user.name }}
          </p>
        </li>
      </ul>
      <p v-else>No comments yet.</p>
      <form
        @submit.prevent="postComment"
        v-show="isLogin"
        class="form"
      >
        <textarea
          class="form__item"
          v-model="newComment"
        ></textarea>
        <div class="form__button">
          <button
            type="submit"
            class="button button--inverse"
            :disabled="!newComment"
          >
            submit comment
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
