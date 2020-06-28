<template>
  <v-card>
    <v-img class="white--text align-end" :src="`/storage/${article.coverImage}`" height="250px" />
    <v-card-title>{{ article.title }}</v-card-title>

    <v-card-subtitle>{{ article.author }}</v-card-subtitle>

    <v-card-text>{{ article.description }}</v-card-text>

    <v-card-actions>
      <v-btn
        link
        :to="`/articles/view/${article.id}`"
        color="orange lighten-2"
        text
      >
        {{ $t('read') }}
      </v-btn>
      
      <v-btn
        v-if="isEdit"
        link
        :to="`/articles/create/content/${article.id}`"
        color="green"
        text
      >
        {{ $t('read') }}
      </v-btn>

      <v-spacer></v-spacer>

      <span class="article-like-count">
        {{ article.likesCount }}
      </span>
      <v-btn icon @click="toggleLike()">
        <v-icon v-if="article.isLiked" color="red">mdi-heart</v-icon>
        <v-icon v-else>mdi-heart-outline</v-icon>
      </v-btn>

      <v-btn icon @click="toggleSave()">
        <v-icon v-if="article.isBookmarked" color="orange lighten-1">mdi-bookmark</v-icon>
        <v-icon v-else>mdi-bookmark-outline</v-icon>
      </v-btn>

      <v-btn @click="showShareModal = !showShareModal" icon>
        <v-icon>mdi-share-variant</v-icon>
      </v-btn>
    </v-card-actions>

    <ShareModal
      :article="article"
      :modalIsOpen="showShareModal"
      @modalBackgroundClicked="showShareModal = false"
    />

  </v-card>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import ShareModal from '~/components/base/ShareModal.vue'

export default {
  name: "ArticleCard",
  components: { ShareModal },
  props: {
    article: {
      type: Object
    },
    isEdit: {
      type: Boolean
    }
  },
  data: () => ({
    showShareModal: false
  }),
  computed: {
    ...mapGetters({
      vxIsAuth: 'auth/check'
    }),
  },
  methods: {
    toggleLike() {
      if (!this.vxIsAuth) {
        this.relocateToLogin()
        return
      }

      axios.post(`/api/article/${this.article.id}/like`)
        .then(() => {
          this.article.isLiked = !this.article.isLiked
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'danger',
            body: this.$t('articleLikeError'),
            isAutoRemove: true
          })
        })
    },
    toggleSave() {
      if (!this.vxIsAuth) {
        this.relocateToLogin()
        return
      }

      axios.post(`/api/article/${this.article.id}/bookmark`)
        .then(() => {
          this.article.isBookmarked = !this.article.isBookmarked
        })
        .catch(() => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'danger',
            body: this.$t('articleSaveError'),
            isAutoRemove: true
          })
        })
    },
    relocateToLogin() {
      this.$router.push({ name: 'login' })
    }
  }
};
</script>

<style lang="scss" scoped>
.article-like-count {
  padding-right: 3px;
  font-size: 12px;
  font-weight: 600;
}
</style>