<script setup>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const router = useRouter();

onMounted(() => {
  store.dispatch('auth/loginUser');
});
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
    <RouterLink
      v-else
      class="button button--link"
      to="/login"
    >
      Login / Register
    </RouterLink>
  </footer>
</template>
