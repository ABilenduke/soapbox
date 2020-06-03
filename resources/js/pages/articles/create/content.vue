<template>
  <v-container v-if="article">
    <v-row>
      <v-col>
        <v-img :src="`/storage/${article.coverImage}`" />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-text-field
          v-model="article.title"
          name="title"
          :label="$t('title')"
          required
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-text-field
          v-model="article.subtitle"
          name="subtitle"
          :label="$t('subtitle')"
          required
        />
      </v-col>
    </v-row>
    <v-row class="pa-3">
      <v-col class="wysiwyg-container">
        <WYSCreator :options="editorOption"/>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  // import WYSContent from '~/page/article/WYSContent.vue'
  import WYSCreator from '~/components/page/article/WYSCreator.vue'
  import axios from 'axios'
  import { ADD_MESSAGE } from '~/store/mutation-types'

  export default {
    name: "CreateContentPage",
    components: {WYSCreator},
    middleware: 'auth',
    data: () => ({
      title: null,
      subtitle: null,
      article: null,
      editorOption: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{'header': 1}, {'header': 2}],
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'script': 'sub'}, {'script': 'super'}],
            [{'indent': '-1'}, {'indent': '+1'}],
            [{'direction': 'rtl'}],
            [{'size': ['small', false, 'large', 'huge']}],
            [{'header': [1, 2, 3, 4, 5, 6, false]}],
            [{'font': []}],
            [{'color': []}, {'background': []}],
            [{'align': []}],
            ['clean'],
            ['link', 'image', 'video']
          ],
          syntax: {
            highlight: text => hljs.highlightAuto(text).value
          }
        }
      }
    }),
    async created() {
      const articleId = this.$route.params.articleId

      await axios.get(`/api/article/${articleId}`)
        .then(({ data }) => {
          this.article = data.article
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'warning',
            body: this.$t('articleNotFound'),
            isAutoRemove: true
          })
        })
    }
  }
</script>

<style lang="scss" scoped>
.wysiwyg-container {
  background-color: #f1f2f3;
  color: #333333;
  height: fit-content;
  border-radius: 5px;
  padding: 10px;
}
::v-deep .ql-container {
  min-height: 350px;
}
</style>
