<template>
  <v-container :ref="generatedRef" @scroll="handleScroll" fluid>
    <v-row dense>
      <slot></slot>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: 'InfiniteScroll',
  data: () => ({
    generatedRef: null
  }),
  created() {
    window.addEventListener('scroll', this.handleScroll);
    this.generatedRef = this.getUniqueIdentifier('infinte-scroll')
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
        this.$emit('hitTheBottom')
      }
    }
  }
};
</script>