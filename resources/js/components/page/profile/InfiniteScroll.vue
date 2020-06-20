<template>
  <v-container :ref="generatedRef" fluid @scroll="checkPosition">
    <v-row dense>
      <v-col v-for="article in articles" :key="article.key" :lg="article.flex" :sm="12">
        <ArticleCard :article="article" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ProfileCard from '~/components/base/ProfileCard.vue'

export default {
  name: 'ProfileInfiniteScroll',
  props: {
    articles: {
      type: Object,
      default: {}
    }
  },
  data: () => ({
    generatedRef: null
  }),
  created() {
    this.generatedRef = getUniqueIdentifier('article-infinte-scroll')
  },
  methods: {
    getUniqueIdentifier(type) {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      }
      return `${type}-${s4()}${s4()}-${s4()}-${s4()}-${s4()}-${s4()}${s4()}${s4()}`;
    },
    checkPosition() {
      // this.refs[this.generatedRef].documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
      let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;

      if (bottomOfWindow) {
        axios.get(`/api/article?page=${this.nextPage}`)
          .then(response => {
            this.persons.push(response.data.results[0]);
          });
      }
    }
  }
};
</script>