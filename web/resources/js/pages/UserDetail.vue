<script setup>
import { computed, defineProps } from 'vue';
import { useStore } from 'vuex';
import PhotoItem from '../components/PhotoItem';
import { alertLogin } from '../functions/alertLogin';

const store = useStore();
const props = defineProps({
  id: {
    type: String,
    required: true,
  },
});

store.dispatch('user/getUser', props.id);
const user = computed(() => store.getters['user/user']);
const isLogin = computed(
  () => store.getters['auth/isLogin']
);
const hasErrors = computed(
  () => store.getters['like/hasErrors']
);

const onLikeClick = ({ id, liked }) => {
  alertLogin(isLogin.value);
  if (liked) {
    store.dispatch('like/delete', id);
  } else {
    store.dispatch('like/put', id);
  }
  if (!hasErrors.value) {
    store.dispatch('user/getUser', props.id);
  }
};
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
        :photo="photo"
        @like="onLikeClick"
      />
    </div>
  </div>
</template>
