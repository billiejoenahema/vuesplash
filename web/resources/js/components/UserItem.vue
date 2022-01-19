<script setup>
import { defineProps } from 'vue';
const props = defineProps({
  user: Object,
  isLogin: Boolean,
  page: {
    type: Number,
    required: false,
  },
});
</script>

<template>
  <div class="photo">
    <router-link
      class="photo__overlay"
      :to="`/users/${props.user.id}`"
    >
      <div class="photo__username">
        {{ props.user.name }}
      </div>
    </router-link>
  </div>
</template>
