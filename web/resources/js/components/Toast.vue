<script setup>
import { computed } from 'vue';
import { store } from '../store';

const toast = computed(() => store.getters.content);
</script>

<template>
  <div class="toast" v-show="toast">
    {{ toast }}
  </div>
</template>
