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
        <v-btn @click="createModalIsOpen = true"  color="green" dark>
          <v-icon>
            mdi-plus-circle
          </v-icon>
          <span>
            {{ $t('create.title') }}
          </span>
        </v-btn>
      </v-col>
    </v-row>

    <v-tabs
      v-model="tab"
      background-color="primary accent-4"
      class="elevation-2"
      dark
      grow
    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab
        v-for="tab in tabs"
        :key="tab"
        :href="`#tab-${tab}`"
      >
        {{ $t(tab) }}
      </v-tab>

      <v-tab-item
        v-for="tab in tabs"
        :key="tab"
        :value="'tab-' + tab"
      >
        <v-card
          flat
          tile
        >
          <InfiniteScroll
            :title="`create-articles-${tab}`"
            :endpoint="`/api/user/articles/${tab}`"
            :component="articleCardComponent"
          />
        </v-card>
      </v-tab-item>
    </v-tabs>

    <CreateModal
      :modalIsOpen="createModalIsOpen"
      @modalBackgroundClicked="createModalIsOpen = false"
      @articleCreated="relocateToContent"
    />
  </v-container>
</template>

<script>
import ArticleCard from '~/components/base/ArticleCard'
import CreateModal from '~/components/page/article/CreateModal.vue'

export default {
  name: 'CreateArticlePage',
  middleware: 'auth',
  components: { CreateModal, ArticleCard },
  data: () => ({
    tab: null,
    tabs: ['drafts', 'published'],
    createModalIsOpen: false,
    articleCardComponent: ArticleCard
  }),
  methods: {
    relocateToContent(articleId) {
      this.$router.push({
        name: 'articles.create.content',
        params: { articleId: articleId}
      })
    }
  }
}
</script>
