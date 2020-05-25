<template>
  <div v-if="modalIsOpen" class="modal-container" @click="$emit('modalBackgroundClicked')">
    <div class="modal-content" @click.stop="">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalComponent',
  props: {
    modalIsOpen: {
      type: Boolean
    }
  }
}
</script>

<style lang="scss" scoped>
.modal-container {
  display: flex;
  justify-content: center;
  align-content: center;
  align-items: center;
  position: fixed;
  background-color: rgba(0, 0, 0, 0.9);
  top: 0;
  left: 0;
  z-index: 100;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
  padding: 5px;
}
.modal-content {
  width: 100%;
  max-width: 900px;
  height: fit-content;
  max-height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  z-index: 101;
  background-color: #fff;
}
</style>