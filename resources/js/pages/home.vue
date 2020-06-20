<template>
  <InfiniteScroll v-if="articles" :articles="articles" @hitTheBottom="getResults()" />
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
    paginatedArticles: null,
    articles: []
  }),
  async created() {
    await this.getResults();
  },
  methods: {
    getResults() {
      if (
        this.paginatedArticles &&
        this.paginatedArticles.current_page === this.paginatedArticles.last_page
      )
        return;

      let page = 1;

      if (
        this.paginatedArticles &&
        this.paginatedArticles.current_page < this.paginatedArticles.last_page
      ) {
        page = this.paginatedArticles.current_page + 1;
      }

      this.isLoading = true;
      axios
        .get("/api/article?page=" + page)
        .then(({ data }) => {
          this.paginatedArticles = data.articles;
          data.articles.data.map(article => {
            this.articles.push(article);
          });
        })
        .finally(() => (this.isLoading = false));
    }
  }
};
</script>