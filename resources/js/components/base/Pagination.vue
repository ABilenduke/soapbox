<template>
  <v-pagination
    v-model="selectedPage"
    :circle="isCircle"
    :disabled="isDisabled"
    :length="data.last_page"
    :next-icon="nextIcon"
    :prev-icon="prevIcon"
    :page="data.current_page"
    :total-visible="totalVisible"
    @input="$emit('pageChange', selectedPage)"
  ></v-pagination>
</template>

<script>
export default {
  name: 'Pagination',
  props: {
    data: {
      type: Object,
      required: true
    },
    isCircle: {
      type: Boolean
    },
    isDisabled: {
      type: Boolean
    }
  },
  data: () => ({
    selectedPage: 1,
    nextIcon: 'mdi-chevron-right',
    prevIcon: 'mdi-chevron-left',
  }),
  computed: {
    totalVisible() {
      return this.data.last_page < 10 ? this.data.last_page : 10;
    }
  },
  created() {
    this.selectedPage = this.data.current_page
  }
}
</script>