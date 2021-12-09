<script setup>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
import Toast from './components/Toast.vue';
</script>

<template>
  <div>
    <header>
      <Navbar />
    </header>
    <main>
      <div class="container">
        <Toast />
        <RouterView />
      </div>
    </main>
    <Footer />
  </div>
</template>
