<template>
  <Modal :modalIsOpen="modalIsOpen" @modalBackgroundClicked="$emit('modalBackgroundClicked')">
    <ArticleMetaInfo />
  </Modal>
</template>

<script>
import ArticleMetaInfo from '~/components/page/article/ArticleMetaInfo.vue'

export default {
  name: "CreateArticleModal",
  components: { ArticleMetaInfo },
  props: {
    modalIsOpen: {
      type: Boolean
    }
  },
  data: () => ({
    imageModalIsOpen: false
  }),
};
</script>
