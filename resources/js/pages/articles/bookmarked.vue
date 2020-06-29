<template>
  <InfiniteScroll
    title="bookmarked-articles"
    endpoint="/api/article/bookmarks"
    :component="articleCardComponent"
  />
</template>

<script>
import ArticleCard from "~/components/base/ArticleCard.vue"

export default {
  name: "BookmarkedPage",
  components: { ArticleCard },
  middleware: 'auth',
  data: () => ({
    articleCardComponent: ArticleCard
  })
};
</script>