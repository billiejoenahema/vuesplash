<template>
  <div>
    <header>
      <BaseNavbar />
    </header>
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
    <BaseFooter />
  </div>
</template>

<script>
import BaseNavbar from './components/BaseNavbar.vue';
import BaseFooter from './components/BaseFooter.vue';

export default {
  components: {
    BaseNavbar,
    BaseFooter,
  },
};
</script>
