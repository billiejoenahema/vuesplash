<script setup>
import { computed, reactive, ref } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const store = useStore();
const router = useRouter();

const tab = ref('login');
const changeTab = (tabName) => {
  tab.value = tabName;
};

const loginForm = reactive({
  email: '',
  password: '',
});

const registerForm = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const hasErrors = computed(
  () => store.getters['auth/hasErrors']
);

const errors = computed(() => store.getters['auth/errors']);

const login = async () => {
  await store.dispatch('auth/login', loginForm);
  if (!hasErrors.value) {
    router.push('/');
  }
};
const register = async () => {
  await store.dispatch('auth/register', registerForm);
  await store.dispatch('auth/loginUser');
  if (!hasErrors.value) {
    router.push('/');
  }
};
</script>

<template>
  <div class="container--small">
    <ul class="tab">
      <li
        class="tab__item"
        :class="{ 'tab__item--active': tab === 'login' }"
        @click="changeTab('login')"
      >
        Login
      </li>
      <li
        class="tab__item"
        :class="{ 'tab__item--active': tab === 'register' }"
        @click="changeTab('register')"
      >
        Register
      </li>
    </ul>
    <div class="panel" v-show="tab === 'login'">
      <form class="form" @submit.prevent="login">
        <label for="login-email">Email</label>
        <input
          type="email"
          class="form__item"
          id="login-email"
          v-model="loginForm.email"
        />
        <label for="login-password">Password</label>
        <input
          type="password"
          class="form__item"
          id="login-password"
          v-model="loginForm.password"
        />
        <div class="form__button">
          <div class="errors" v-show="hasErrors">
            {{ errors[0] }}
          </div>
          <button
            type="submit"
            class="button button--inverse"
            @click="login"
          >
            login
          </button>
        </div>
      </form>
    </div>
    <div class="panel" v-show="tab === 'register'">
      <form class="form" @submit.prevent="register">
        <label for="username">Name</label>
        <input
          type="text"
          class="form__item"
          id="username"
          v-model="registerForm.name"
        />
        <label for="email">Email</label>
        <input
          type="email"
          class="form__item"
          id="email"
          v-model="registerForm.email"
        />
        <label for="password">Password</label>
        <input
          type="password"
          class="form__item"
          id="password"
          v-model="registerForm.password"
        />
        <label for="password-confirmation"
          >Password (confirm)</label
        >
        <input
          type="password"
          class="form__item"
          id="password-confirmation"
          v-model="registerForm.password_confirmation"
        />
        <div class="form__button">
          <div class="errors" v-show="hasErrors">
            {{ errors[0] }}
          </div>
          <button
            type="submit"
            class="button button--inverse"
          >
            register
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
