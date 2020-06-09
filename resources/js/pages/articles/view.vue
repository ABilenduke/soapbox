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

    <v-row
      v-for="(section, index) in content"
      :key="`article-content-${index}`"
      class="pa-3"
    >
      <v-col class="wysiwyg-container">
        <div v-html="section.content"></div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { ADD_MESSAGE } from '~/store/mutation-types'

export default {
  name: "ArticleView",
  data: () => ({
    articleId: null,
    article: null,
    content: null
  }),
  async created() {
    this.articleId = this.$route.params.articleId;

    await axios
      .get(`/api/article/${this.articleId}`)
      .then(({ data }) => {
        this.article = data.article;
      })
      .catch(() => {
        this.$store.commit(`flash/${ADD_MESSAGE}`, {
          level: "warning",
          body: this.$t("articleNotFound"),
          isAutoRemove: true
        });
      });

    await axios
      .get(`/api/article/${this.articleId}/content`)
      .then(({ data }) => {
        this.content = data.content;
      })
      .catch(() => {
        this.$store.commit(`flash/${ADD_MESSAGE}`, {
          level: "warning",
          body: this.$t("articleContentNotFound"),
          isAutoRemove: true
        });
      });
  }
};
</script>