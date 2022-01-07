<script setup>
import { computed } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

const toast = computed(() => store.getters.content);
</script>

<template>
  <div class="toast" v-show="toast">
    {{ toast }}
  </div>
</template>
