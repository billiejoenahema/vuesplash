<script setup>
import TheNavbar from './components/TheNavbar.vue';
import TheFooter from './components/TheFooter.vue';
import TheToast from './components/TheToast.vue';
</script>

<template>
  <div>
    <header>
      <TheNavbar />
    </header>
    <main>
      <TheToast />
      <div class="container">
        <router-view />
      </div>
    </main>
    <TheFooter />
  </div>
</template>
