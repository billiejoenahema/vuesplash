<script setup>
import { computed, defineProps, watchEffect } from 'vue';
import { useStore } from 'vuex';
import ThePagination from '../components/ThePagination';
import UserItem from '../components/UserItem';

const store = useStore();
const props = defineProps({
  page: {
    type: Number,
    required: false,
    default: 1,
  },
});

const isLogin = computed(
  () => store.getters['auth/isLogin']
);

watchEffect(() => {
  store.dispatch('user/getUsers', props.page);
});
const users = computed(() => store.getters['user/users']);

const userCount = computed(
  () => store.getters['user/userCount']
);
const currentPage = computed(
  () => store.getters['user/currentPage']
);
const lastPage = computed(
  () => store.getters['user/lastPage']
);
</script>

<template>
  <div>ユーザー数: {{ userCount }}</div>
  <div class="photo-list">
    <div class="grid">
      <UserItem
        v-for="user in users"
        :key="user.id"
        :user="user"
        :isLogin="isLogin"
        :page="page"
      />
    </div>
    <ThePagination
      :current-page="currentPage"
      :last-page="lastPage"
    />
  </div>
</template>
