<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const toast = computed(() => store.getters['toast/toast']);
</script>

<template>
  <div class="toast" v-show="toast">
    {{ toast }}
  </div>
</template>
