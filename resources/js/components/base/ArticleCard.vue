<template>
  <v-card>
    <v-img class="white--text align-end" :src="`/storage/${content.coverImage}`" height="250px" />
    <v-card-title>{{ content.title }}</v-card-title>

    <v-card-subtitle>{{ content.author }}</v-card-subtitle>

    <v-card-text>{{ content.description }}</v-card-text>

    <v-card-actions>
      <v-btn
        link
        :to="`/articles/view/${content.id}`"
        color="orange lighten-2"
        text
      >
        {{ $t('read') }}
      </v-btn>
      
      <v-btn
        v-if="isEdit"
        link
        :to="`/articles/create/content/${content.id}`"
        color="green"
        text
      >
        {{ $t('edit') }}
      </v-btn>

      <v-spacer></v-spacer>

      <span class="article-like-count">
        {{ content.likesCount }}
      </span>
      <v-btn icon @click="toggleLike()">
        <v-icon v-if="content.isLiked" color="red">mdi-heart</v-icon>
        <v-icon v-else>mdi-heart-outline</v-icon>
      </v-btn>

      <v-btn icon @click="toggleSave()">
        <v-icon v-if="content.isBookmarked" color="orange lighten-1">mdi-bookmark</v-icon>
        <v-icon v-else>mdi-bookmark-outline</v-icon>
      </v-btn>

      <v-btn @click="showShareModal = !showShareModal" icon>
        <v-icon>mdi-share-variant</v-icon>
      </v-btn>
    </v-card-actions>

    <ShareModal
      :article="content"
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
    content: {
      type: Object
    }
  },
  data: () => ({
    showShareModal: false,
  }),
  computed: {
    ...mapGetters({
      vxAuthUser: 'auth/user',
      vxIsAuth: 'auth/check'
    }),
    isEdit() {
      if (!this.vxIsAuth) {
        return false
      }
      return this.content.user_id === this.vxAuthUser.id 
    }
  },
  methods: {
    toggleLike() {
      if (!this.vxIsAuth) {
        this.relocateToLogin()
        return
      }

      axios.post(`/api/article/${this.content.id}/like`)
        .then(() => {
          this.content.isLiked = !this.content.isLiked

          if (this.content.isLiked) {
            this.content.likesCount += 1
          } else {
            this.content.likesCount -= 1
          }
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

      axios.post(`/api/article/${this.content.id}/bookmark`)
        .then(() => {
          this.content.isBookmarked = !this.content.isBookmarked
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