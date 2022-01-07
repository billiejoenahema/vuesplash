<script setup>
import { computed, defineProps } from 'vue';
const props = defineProps({
  currentPage: Number,
  lastPage: Number,
});

const isFirstPage = computed(() => props.currentPage === 1);
const isLastPage = computed(
  () => props.currentPage === props.lastPage
);
</script>

<template>
  <div class="pagination">
    <router-link
      v-if="!isFirstPage"
      :to="`/?page=${currentPage - 1}`"
      class="button"
      >&laquo; prev</router-link
    >
    <router-link
      v-if="!isLastPage"
      :to="`/?page=${currentPage + 1}`"
      class="button"
      >next &raquo;</router-link
    >
  </div>
</template>
