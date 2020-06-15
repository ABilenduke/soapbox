<template>
  <v-container v-if="article">
    <v-row>
      <v-col>
        <v-img :src="`/storage/${article.coverImage}`" contain :aspect-ratio="16 / 9" />
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h4>{{ $t('title') }}</h4>
        <h5>
          {{ article.title }}
        </h5>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h4>{{ $t('subtitle') }}</h4>
        <h5>
          {{ article.subtitle }}
        </h5>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h4>{{ $t('description') }}</h4>
        <p>{{ article.description }}</p>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-btn :disabled="highestOrder >= 5" @click="addContent()">
          <v-icon>
            mdi-plus-circle
          </v-icon>
          <span class="addText">
            {{ $t('addContent') }}
          </span>
        </v-btn>
      </v-col>
      <v-col justify="flex-end">
        <v-btn @click="publishArticle()" color="green">
          <v-icon>
            mdi-publish
          </v-icon>
          <span class="addText">
            {{ $t('publishArticle') }}
          </span>
        </v-btn>
      </v-col>
    </v-row>

    <v-row
      v-for="(section, index) in content"
      :key="`article-content-${index}`"
      class="pa-3"
    >
      <v-col class="wysiwyg-container">
        <WYSCreator
          :options="editorOption"
          :initialContent="section.content"
          @contentHasUpdated="contentHasUpdated($event, section.id)"
        />
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
      articleId: null,
      article: null,
      content: null,
      highestOrder: 0,
      editorOption: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{'header': 1}, {'header': 2}, {'header': 3}],
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'script': 'sub'}, {'script': 'super'}],
            [{'indent': '-1'}, {'indent': '+1'}],
            [{'direction': 'rtl'}],
            [{'size': ['small', false, 'large', 'huge']}],
            [{'header': [1, 2, 3, 4, 5, 6, false]}],
            [{'font': []}],
            [{'color': []}, {'background': []}],
            [{'align': []}],
            [{'counter': [{'unit': 'word'}]}]
            ['clean'],
            ['link', 'video']
          ],
          syntax: {
            highlight: text => hljs.highlightAuto(text).value
          }
        }
      }
    }),
    async created() {
      this.articleId = this.$route.params.articleId

      await axios.get(`/api/article/${this.articleId}`)
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

      await axios.get(`/api/article/${this.articleId}/content`)
        .then(({ data }) => {
          this.content = data.content
          this.highestOrder = this.content.reduce((accumulator, section) => {
            return section.order > accumulator ? section.order : accumulator
          }, 0)
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'warning',
            body: this.$t('articleContentNotFound'),
            isAutoRemove: true
          })
        })
    },
    methods: {
      contentHasUpdated(content, contentId) {
        axios.put(`/api/article/content/${contentId}`, {
          content: content
        })
        .then(({ data }) => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'success',
            body: this.$t('articleContentSaved'),
            isAutoRemove: true
          })
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'danger',
            body: this.$t('articleContentDidNotSave'),
            isAutoRemove: true
          })
        })
      },
      addContent() {
        axios.post(`/api/article/${this.articleId}/content`, { highestOrder: this.highestOrder})
        .then(({ data }) => {
          this.content.push(data.content)
          this.highestOrder += 1

          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'success',
            body: this.$t('articleContentSectionAdded'),
            isAutoRemove: true
          })
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'danger',
            body: this.$t('articleContentSectionWasNotAdded'),
            isAutoRemove: true
          })
        })
      },
      publishArticle() {
        axios.post(`/api/article/${this.articleId}/publish`)
        .then(({ data }) => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'success',
            body: this.$t('articlePublished'),
            isAutoRemove: true
          })

          this.$router.push({
            name: 'articles.view',
            params: { articleId: this.articleId }
          })
        })
        .catch((error) => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'danger',
            body: this.$t('articleNotPublished'),
            isAutoRemove: true
          })
        })
      }
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
.addText {
  padding-left: 5px;
}
</style>
