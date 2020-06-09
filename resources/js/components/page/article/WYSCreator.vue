<template>
  <quill-editor
    ref="myQuillEditor"
    v-model="content"
    :options="options"
    @change="debounceTextChanges($event)"
  />
</template>

<script>
  import 'quill/dist/quill.core.css'
  import 'quill/dist/quill.snow.css'
  import 'quill/dist/quill.bubble.css'

  import _ from 'lodash'
  import { quillEditor } from 'vue-quill-editor'

  export default {
    name: "WYSCreator",
    components: {
      quillEditor
    },
    props: {
      options: {
        type: Object
      },
      initialContent: {
        type: String
      }
    },
    data: () => ({
      content: null
    }),
    computed: {
      editor() {
        return this.$refs.myQuillEditor.quill
      }
    },
    created() {
      this.content = this.initialContent
    },
    methods: {
      debounceTextChanges: _.debounce(function () {
        this.$emit('contentHasUpdated', this.content)
      }, 1000)
    },
  }
</script>

<style scoped>

</style>
