<template>
  <InfiniteScroll
    title="home-articles"
    endpoint="/api/article"
    :component="articleCardComponent"
  />
</template>

<script>
import ArticleCard from "~/components/base/ArticleCard.vue"

export default {
  name: "HomePage",
  components: { ArticleCard },
  data: () => ({
    articleCardComponent: ArticleCard
  })
};
</script>