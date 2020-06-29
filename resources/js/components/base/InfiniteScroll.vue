<template>
  <v-container :ref="generatedRef" @scroll="handleScroll" fluid>
    <v-row v-if="contents" dense>
      <v-col
        v-for="(content, index) in contents"
        :key="`contents-${index}`"
        :xl="getColumn(index, 'xl')"
        :lg="getColumn(index, 'lg')"
        :md="getColumn(index, 'md')"
        :sm="getColumn(index, 'sm')"
        :xs="getColumn(index, 'xs')"
      >
        <component :is="component" :content="content">
          <slot />
        </component>
      </v-col>
    </v-row>
    <v-row v-else>
      <v-col>
        <p>
          {{ $t(nothingFoundMessage) }}
        </p>
      </v-col>
    </v-row>
    <v-row v-if="contents && hitTheEnd">
      <v-col>
        <p>
          {{ $t('hitTheEnd') }}
        </p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import structures from '~/helpers/cards/structures.js'

export default {
  name: 'InfiniteScroll',
  props: {
    title: {
      type: String,
      required: true
    },
    endpoint: {
      type: String,
      required: true
    },
    component: {
      type: [String, Object],
      required: true
    },
    structure: {
      type: String,
      default: 'default'
    },
    nothingFoundMessage: {
      type: String,
      default: 'nothingFound'
    }
  },
  data: () => ({
    generatedRef: null,
    paginatedContents: null,
    contents: [],
    isLoading: false,
    hitTheEnd: false
  }),
  watch: {
    isLoading(value) {
      if (value) {
        this.$emit('isLoading')
      } else {
        this.$emit('finishedLoading')
      }
    }
  },
  created() {
    window.addEventListener('scroll', this.handleScroll);
    this.generatedRef = this.getUniqueIdentifier(`infinte-scroll-${this.title}`)
    this.getResults()
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  },
  methods: {
    getUniqueIdentifier(type) {
      function s4() {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      }
      return `${type}-${s4()}${s4()}`;
    },
    handleScroll() {
      let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight === document.documentElement.offsetHeight;
      if (bottomOfWindow) {
        this.getResults()
      }
    },
    getResults() {
      if (
        this.paginatedContent &&
        this.paginatedContent.current_page === this.paginatedContent.last_page
      ) {
        this.hitTheEnd = true
        return;
      }

      let page = 1;

      if (
        this.paginatedContent &&
        this.paginatedContent.current_page < this.paginatedContent.last_page
      ) {
        page = this.paginatedContent.current_page + 1;
      }

      this.isLoading = true;
      axios
        .get(`${this.endpoint}?page=${page}`)
        .then(({ data }) => {
          this.paginatedContent = data.contents;
          data.contents.data.map(content => {
            this.contents.push(content);
          });
        })
        .finally(() => (this.isLoading = false));
    },
    getColumn(index, size) {
      const number = String(index).slice(-1)
      return structures[this.structure][size][number]
    }
  }
};
</script>