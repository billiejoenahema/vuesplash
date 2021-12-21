<script setup>
import {
  computed,
  defineProps,
  ref,
  watchEffect,
} from 'vue';
import { useStore } from 'vuex';
import Photo from '../components/Photo';
import Pagination from '../components/Pagination';

const store = useStore();
const props = defineProps({
  page: {
    type: Number,
    required: false,
    default: 1,
  },
});

const searchWord = ref('');
const search = () => {
  const elements = Array.from(
    document.getElementsByClassName('messageBody')
  );
  const regexp = new RegExp(
    '(' + searchWord.value + ')',
    'gi'
  );
  const highlight = '<span class="highlight">$1</span>';
  elements.forEach((el) => {
    console.log(el);
    el.innerHTML = el.innerHTML.replace(regexp, highlight);
  });
};

const currentPage = computed(
  () => store.getters['photo/currentPage']
);
const lastPage = computed(
  () => store.getters['photo/lastPage']
);

store.dispatch('photo/getPhotos', props.page);
const photos = computed(
  () => store.getters['photo/photos']
);

watchEffect(() => {
  store.dispatch('photo/getPhotos', props.page);
});
</script>

<style>
.highlight {
  color: red;
}
</style>

<template>
  <input v-model="searchWord" />
  <button @click="search">検索</button>
  <div class="messageBody">
    この連載記事では、フロントエンドに Vue.js + Vue Router +
    Vuex とサーバーサイドに Laravel を使用したシングルページ
    Web
    アプリケーションの開発方法を紹介します。実際に写真共有アプリを開発する手順を通して
    SPA 開発のエッセンスを学ぶことができます。
    今回のチュートリアルで扱うツールなどのバージョンは以下の通りです。
  </div>
  <div class="messageBody">
    この連載記事では、フロントエンドに Vue.js + Vue Router +
    Vuex とサーバーサイドに Laravel を使用したシングルページ
    Web
    アプリケーションの開発方法を紹介します。実際に写真共有アプリを開発する手順を通して
    SPA 開発のエッセンスを学ぶことができます。
    今回のチュートリアルで扱うツールなどのバージョンは以下の通りです。
  </div>
  <div class="photo-list">
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="photo in photos"
        :key="photo.id"
        :item="photo"
      />
    </div>
    <Pagination
      :current-page="currentPage"
      :last-page="lastPage"
    />
  </div>
</template>
