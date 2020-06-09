<template>
  <v-container>
    <v-row>
      <v-col>
        <h1>
          {{ $t('create.index.title') }}
        </h1>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-btn @click="createModalIsOpen = true">
          <v-icon>
            mdi-plus-circle
          </v-icon>
          <span>
            {{ $t('create.title') }}
          </span>
        </v-btn>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <h2>{{ $t('drafts') }}</h2>
        <v-container v-if="draftArticles && draftArticles.data.length > 0" fluid>
          <v-row dense>
            <v-col
              v-for="article in draftArticles.data"
              :key="article.identifier"
              :cols="6"
            >
              <ArticleCard :article="article" isEdit />
            </v-col>
          </v-row>
        </v-container>
        <v-container v-else>
          <v-row dense>
            <v-col>
              <p>
                {{ $t('noDrafts') }}
              </p>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>

    <CreateModal
      :modalIsOpen="createModalIsOpen"
      @modalBackgroundClicked="createModalIsOpen = false"
      @articleCreated="relocateToContent"
    />
  </v-container>
</template>

<script>
import ArticleCard from '~/components/base/ArticleCard'
import axios from 'axios'
import CreateModal from '~/components/page/article/CreateModal.vue'

export default {
  name: '',
  middleware: 'auth',
  components: { CreateModal, ArticleCard },
  data: () => ({
    isSubmitting: false,
    draftArticles: null,
    publishedArticles: null,
    createModalIsOpen: false
  }),
  created() {
    this.getDraftArticles()
    this.getPublishedArticles()
  },
  methods: {
    getDraftArticles() {
      this.isSubmitting = true

      axios.get('/api/user/articles/drafts')
        .then(({ data }) => {
          this.draftArticles = data.articles
        })
        .catch(() => {

        })
        .finally(() => this.isSubmitting = false)
    },
    getPublishedArticles() {
      this.isSubmitting = true

      axios.get('/api/user/articles/published')
        .then(() => {
          this.publishedArticles = data.articles
        })
        .catch(() => {

        })
        .finally(() => this.isSubmitting = false)
    },
    relocateToContent(articleId) {
      this.$router.push({
        name: 'articles.create.content',
        params: { articleId: articleId}
      })
    }
  }
}
</script>
