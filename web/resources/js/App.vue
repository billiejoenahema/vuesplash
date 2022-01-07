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
      <div class="container">
        <TheToast />
        <router-view />
      </div>
    </main>
    <TheFooter />
  </div>
</template>
