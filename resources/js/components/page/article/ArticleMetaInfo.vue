<template>
  <ValidationObserver ref="createArticleEditObserver" v-slot="{ invalid }">
    <v-card>
      <v-card-title>
        <slot name="title-bar">{{ $t('create.new.title') }}</slot>
      </v-card-title>

      <v-card-text class="crop-body">
        <v-container class="py-0">
          <v-row>
            <v-col cols="12">
              <ValidationProvider v-slot="{ errors }" name="title" rules="required|max:255">
                <v-text-field
                  v-model="form.title"
                  :label="$t('title')"
                  :error-messages="errors"
                  required
                />
              </ValidationProvider>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <ValidationProvider v-slot="{ errors }" name="subtitle" rules="max:255">
                <v-text-field
                  v-model="form.subtitle"
                  :label="$t('subtitle')"
                  :error-messages="errors"
                  required
                />
              </ValidationProvider>
            </v-col>
          </v-row>

          <v-row v-if="categories">
            <v-col cols="12">
              <ValidationProvider v-slot="{ errors }" name="category" rules="required|max:1000">
                <v-select
                  v-model="form.category"
                  :label="$t('category')"
                  :items="categories"
                  item-text="display"
                  item-value="value"
                  :error-messages="errors"
                  required
                  return-object
                  single-line
                />
              </ValidationProvider>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <ValidationProvider v-slot="{ errors }" name="description" rules="required|max:1000">
                <v-textarea
                  v-model="form.description"
                  :label="$t('description')"
                  :error-messages="errors"
                  required
                />
              </ValidationProvider>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <ValidationProvider v-slot="{}" name="coverImage" rules="required">
                <ImageCropper @imageCropped="addCoverImage" :aspectRatio="16 / 9" />
                <v-img v-if="form.coverImage" :src="form.coverImage" />
              </ValidationProvider>
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn
          color="success"
          class="mr-4"
          :disabled="invalid"
          :loading="form.busy"
          @click="createArticle()"
        >{{ $t('create.title') }}</v-btn>
        <v-btn color="error" class="mr-4" @click="resetForm()">{{ $t('reset') }}</v-btn>
        <v-spacer />
      </v-card-actions>
    </v-card>
  </ValidationObserver>
</template>

<script>
import axios from 'axios'
import { ADD_MESSAGE } from '~/store/mutation-types'

export default {
  props: {
    article: {
      type: Object,
      required: false
    }
  },
  data: () => ({
    categories: null,
    imageModalIsOpen: false,
    form: {
      busy: false,
      title: null,
      subtitle: null,
      description: null,
      category: null,
      coverImage: null
    }
  }),
  created() {
    if (this.article) {
      this.form.title = this.article.title
      this.form.subtitle = this.article.subtitle
      this.form.description = this.article.description
      this.form.category = {
        value: this.article.category,
        display: this.$t(`categories.${this.article.category}`)
      }
      this.form.coverImage = `/storage/${this.article.coverImage}`
    }
    this.getCategories();
  },
  methods: {
    getCategories() {
      this.categories = []

      axios.get('/api/categories')
        .then(({ data }) => {
          data.categories.map(category => {
            this.categories.push({
              value: category.title,
              display: this.$t(`categories.${category.title}`)
            }) 
          })
        })
        .catch(() => {

        })
    },
    addCoverImage(croppedImage) {
      this.form.coverImage = croppedImage
      this.imageModalIsOpen = false
    },
    uploadImageClick(event) {
      event.prevent
      this.imageModalIsOpen = true
    },
    resetForm() {
      this.form.title = null;
      this.form.subtitle = null;
      this.form.category = null;
      this.form.description = null;

      this.$refs.createArticleEditObserver.reset()
    },
    createArticle() {
      this.form.category = this.form.category.value
      axios.post('/api/article', this.form)
        .then(({ data }) => {
          this.$emit('articleCreated', data.article)
        })
        .catch((error) => {
          this.$store.commit(`flash/${ADD_MESSAGE}`, {
            level: 'warning',
            body: this.$t('articleNotCreated'),
            isAutoRemove: true
          })
        })
    }
  }
}
</script>