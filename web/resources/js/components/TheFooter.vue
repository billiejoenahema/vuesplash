<script setup>
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const router = useRouter();

const isLogin = computed(
  () => store.getters['auth/isLogin']
);
const logout = async () => {
  await store.dispatch('auth/logout');
  router.push('/login');
};
</script>

<template>
  <footer class="footer">
    <button
      v-if="isLogin"
      class="button button--link"
      @click="logout"
    >
      Logout
    </button>
    <router-link
      v-else
      class="button button--link"
      to="/login"
      title="ログインページ"
    >
      Login / Register
    </router-link>
  </footer>
</template>
