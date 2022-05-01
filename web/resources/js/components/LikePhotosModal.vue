<script setup>
import PhotoItem from './PhotoItem';
defineProps({
  userName: String,
  likePhotos: Array,
  closeModal: Function,
});
</script>

<template>
  <div>
    <div id="modal-overlay" @click="closeModal"></div>
    <div
      class="modal fade"
      id="photosModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="photosModalTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="photosModalTitle">
              {{ userName }}さんがいいねしたフォト一覧
            </h5>
            <button
              type="button"
              class="close"
              aria-label="Close"
              @click="closeModal"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="photo-list">
              <div class="grid">
                <PhotoItem
                  class="grid__item"
                  v-for="photo in likePhotos"
                  :key="photo.id"
                  :photo="photo"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
#modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.75);
  z-index: 1071;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  outline: 0;
  z-index: 1071;
}
.modal-open .modal {
  overflow-x: hidden;
  overflow-y: auto;
}
.fade {
  transition: opacity 0.15 linear;
  transition-property: opacity;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  transition-delay: 0s;
}
.modal.fade .modal-dialog {
  transition: transform 0.3s ease-out;
}
.modal-dialog {
  max-width: 800px;
  max-height: 800px;
  margin: 5rem auto;
  position: relative;
  width: auto;
  pointer-events: none;
}
.modal-content {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  pointer-events: auto;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  outline: 0;
  z-index: 1072;
}
.modal-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  padding: 1rem;
  border-bottom: 1px px solid #e9ecef;
  border-top-left-radius: 0.3rem;
  border-top-right-radius: 0.3rem;
}
.modal-title {
  margin-bottom: 0;
  line-height: 1.5;
}
.modal-header .close {
  padding: 1rem;
  margin: -1rem -1rem -1rem auto;
}
button.close {
  padding: 0;
  background-color: transparent;
  border: 0;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
.close {
  float: right;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1;
  color: #000;
  text-shadow: 0 1px 0 #fff;
  opacity: 0.5;
}
.modal-body {
  padding: 1rem;
}
</style>
