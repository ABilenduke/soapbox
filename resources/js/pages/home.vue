<template>
  <InfiniteScroll v-if="articles" :articles="articles" @hitTheBottom="fetchMoreArticles()" />
</template>

<script>
import axios from "axios"
import InfiniteScroll from "~/components/page/article/InfiniteScroll.vue"
import { ADD_MESSAGE } from '~/store/mutation-types'
import helpers from "~/helpers"
const { getRandomId } = helpers

export default {
  name: "HomePage",
  components: { InfiniteScroll },
  data: () => ({
    show: false,
    articlesMeta: null,
    articles: []
  }),
  async created() {
    await axios
      .get(`/api/articles`)
      .then(({ data }) => {
        this.articlesMeta = data.articles;
        this.articles = data.articles.data;
      })
      .catch((error) => {
        this.$store.commit(`flash/${ADD_MESSAGE}`, {
          level: "warning",
          body: this.$t("articlesNotFound"),
          isAutoRemove: true
        });
      });
  },
  methods: {
    fetchMoreArticles() {
      console.log("HIT ROCK BOTTOM");
    }
  }
};
</script>