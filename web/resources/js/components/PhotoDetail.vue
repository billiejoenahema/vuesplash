<script setup>
import { computed, defineProps, ref } from 'vue';
import { useStore } from 'vuex';

const store = useStore();
const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

store.dispatch('auth/loginUser');
const isLogin = computed(
  () => store.getters['auth/isLogin']
);
store.dispatch('photo/getPhoto', props.id);
const photo = computed(() => store.getters['photo/photo']);
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
      <figcaption>
        Posted by {{ photo.user.name }}
      </figcaption>
    </figure>
    <div class="photo-detail__pane">
      <button
        class="button button--like"
        title="Like photo"
      >
        <i class="icon ion-md-heart"></i>12
      </button>
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
