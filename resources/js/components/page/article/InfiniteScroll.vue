<template>
  <InfiniteScroll @hitTheBottom="$emit('hitTheBottom')">
    <v-col v-for="(article, index) in articles" :key="`article-${index}`" :lg="getColumn(index)" :sm="12">
      <ArticleCard :article="article" />
    </v-col>
  </InfiniteScroll>
</template>

<script>
import ArticleCard from '~/components/base/ArticleCard.vue'

export default {
  name: 'ArticleInfiniteScroll',
  components: { ArticleCard },
  props: {
    articles: {
      type: Array,
      default: []
    }
  },
  data: () => ({
    generatedRef: null
  }),
  methods: {
    getColumn(index) {
      const number = String(index).slice(-1)
      const columns = {
        "0": 6,
        "1": 6,
        "2": 4,
        "3": 4,
        "4": 4,
        "5": 6,
        "6": 6,
        "7": 4,
        "8": 4,
        "9": 4,
      }

      return columns[number]
    }
  }
};
</script>