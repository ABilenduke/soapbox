<template>
  <v-card>
    <v-img class="white--text align-end" :src="`/storage/${article.coverImage}`" height="250px" />
    <v-card-title>{{ article.title }}</v-card-title>

    <v-card-subtitle>{{ article.author }}</v-card-subtitle>

    <v-card-text>{{ article.description }}</v-card-text>

    <v-card-actions>
      <v-btn text>Share</v-btn>

      <v-btn
        link
        :to="destination"
        color="purple"
        text
      >
        Explore
      </v-btn>

      <v-spacer></v-spacer>

      <span class="article-like-count">
        {{ article.likes }}
      </span>

      <v-btn icon @click="article.liked = !article.liked">
        <v-icon :color="article.liked ? 'red' : ''">mdi-heart</v-icon>
      </v-btn>

      <v-btn icon @click="article.bookmarked = !article.bookmarked">
        <v-icon :color="article.bookmarked ? 'orange lighten-1' : ''">mdi-bookmark</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: "ArticleCard",
  props: {
    article: {
      type: Object
    },
    isEdit: {
      type: Boolean
    }
  },
  data: () => ({
    destination: null
  }),
  created() {
    if (this.isEdit) {
      this.destination = `/articles/create/content/${this.article.id}`
    } else {
      this.destination = `/articles/view/${this.article.id}`
    }
  },
  methods: {}
};
</script>

<style lang="scss" scoped>
.article-like-count {
  padding-right: 3px;
  font-size: 12px;
  font-weight: 600;
}
</style>