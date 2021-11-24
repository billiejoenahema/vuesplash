<template>
  <nav class="navbar">
    <RouterLink class="navbar__brand" to="/">
      Vuesplash
    </RouterLink>
    <div class="navbar__menu">
      <div v-if="isLogin" class="navbar__item">
        <button class="button">
          <i class="icon ion-md-add"></i>
          Submit a photo
        </button>
      </div>
      <span v-if="isLogin" class="navbar__item">
        {{ userName }}
      </span>
      <div v-else class="navbar__item">
        <RouterLink class="button button--link" to="/login">
          Login / Register
        </RouterLink>
      </div>
    </div>
  </nav>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
  setup() {
    const store = useStore();

    store.dispatch('auth/loginUser');
    const isLogin = computed(
      () => store.getters['auth/isLogin']
    );
    const userName = computed(
      () => store.getters['auth/userName']
    );

    return {
      isLogin,
      userName,
    };
  },
};
</script>
