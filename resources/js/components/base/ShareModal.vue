<template>
  <Modal :modalIsOpen="modalIsOpen" @modalBackgroundClicked="$emit('modalBackgroundClicked')">
    
    <v-card>
      <v-card-title>
        <slot name="title-bar">{{ $t('share.title') }}</slot>
      </v-card-title>

      <v-card-text class="crop-body">
        <v-container class="py-0">
          <v-row>
            <v-col>
              <v-text-field
                id="myInput"
                v-model="link"
                :label="$t('link')"
                prepend-icon="mdi-link"
                append-outer-icon="mdi-content-copy"
                @click:prepend="handleShare('link')"
                @click:append-outer="handleShare('link')"
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-btn class="social-button facebook" @click="handleShare('facebook')">
                <v-icon>
                  mdi-facebook
                </v-icon>
                {{ $t('share.facebook') }}
              </v-btn>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-btn class="social-button twitter" @click="handleShare('twitter')">
                <v-icon>
                  mdi-twitter
                </v-icon>
                {{ $t('share.twitter') }}
              </v-btn>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-btn class="social-button pinterest" @click="handleShare('pinterest')">
                <v-icon>
                  mdi-pinterest
                </v-icon>
                {{ $t('share.pinterest') }}
              </v-btn>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-btn class="social-button reddit" @click="handleShare('reddit')">
                <v-icon>
                  mdi-reddit
                </v-icon>
                {{ $t('share.reddit') }}
              </v-btn>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-btn class="social-button linkedin" @click="handleShare('linkedin')">
                <v-icon>
                  mdi-linkedin
                </v-icon>
                {{ $t('share.linkedin') }}
              </v-btn>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-btn class="social-button email" @click="handleShare('email')">
                <v-icon>
                  mdi-email
                </v-icon>
                {{ $t('share.email') }}
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <v-card-actions>
      </v-card-actions>
    </v-card>
  </Modal>
</template>

<script>
import axios from "axios";
import { ADD_MESSAGE } from "~/store/mutation-types";

export default {
  name: "ArticleCard",
  props: {
    article: {
      type: Object
    },
    modalIsOpen: {
      type: Boolean
    }
  },
  data: () => ({
    link: null,
    title: null,
    shareLocations: null
  }),
  created() {
    this.link = `https://soapbox.andrewbilenduke.com/articles/view/${this.article.id}`
    const title = `${this.$t('linkTitle')} ${this.article.title}`

    this.shareLocations = {
      "facebook": `https://www.facebook.com/sharer/sharer.php?u=${this.link}`,
      "twitter": `http://www.twitter.com/share?url=${this.link}`,
      "pinterest": `http://pinterest.com/pin/create/link/?url=${this.link}`,
      "reddit": `http://www.reddit.com/submit?url=${this.link}&title=${title}`,
      "linkedin": `https://www.linkedin.com/shareArticle?mini=true&url=${this.link}&title=${title}&summary=${this.article.description}&source=LinkedIn`,
      "email": `mailto:?subject=${title}&amp;body=${this.article.description}/n${this.link}`
    }
  },
  methods: {
    handleShare(type) {
      this.storeShareData(type)

      if (type !== 'link') {
        this.redirectToSharePage(type)
        return
      }

      this.copyLink()
      return
    },
    copyLink() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      this.$store.commit(`flash/${ADD_MESSAGE}`, {
        level: 'success',
        body: this.$t('articleLinkCopied'),
        isAutoRemove: true
      })
    },
    storeShareData(type) {
      axios.post(`/api/article/${this.article.id}/share`, { type: type })
    },
    redirectToSharePage(type) {
      window.open(this.shareLocations[type], '_blank')
    }
  }
};
</script>

<style lang="scss" scoped>
.social-button {
  i {
    padding-right: 5px;
  }

  &.facebook i {
    color: #3b5999;
  }

  &.twitter i {
    color: #55acee;
  }

  &.pinterest i {
    color: #bd081c;
  }

  &.reddit i {
    color: #ff5700;
  }

  &.linkedin i {
    color: #0077B5;
  }

  &.email i {
    color: #cccccc;
  }
}
</style>
