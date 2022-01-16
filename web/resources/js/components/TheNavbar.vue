<script setup>
import { computed, onMounted, ref } from 'vue';
import { useStore } from 'vuex';
import PhotoForm from './PhotoForm.vue';

const store = useStore();

onMounted(() => {
  store.dispatch('auth/loginUser');
});
const isLogin = computed(
  () => store.getters['auth/isLogin']
);

const userName = computed(
  () => store.getters['auth/userName']
);

const showForm = ref(false);
</script>

<template>
  <nav class="navbar">
    <router-link class="navbar__brand" to="/">
      Vuesplash
    </router-link>
    <div class="navbar__menu">
      <div v-if="isLogin" class="navbar__item">
        <button
          class="button"
          @click="showForm = !showForm"
        >
          <i class="icon ion-md-add"></i>
          Submit a photo
        </button>
      </div>
      <span v-if="isLogin" class="navbar__item">
        {{ userName }}
      </span>
      <div v-else class="navbar__item">
        <router-link
          class="button button--link"
          to="/login"
        >
          Login / Register
        </router-link>
      </div>
    </div>
    <PhotoForm
      v-show="showForm"
      v-model:showForm="showForm"
    />
  </nav>
</template>
