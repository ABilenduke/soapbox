<template>
  <v-container fluid v-if="paginatedUsers">
    <v-row dense>
        <v-col>
          <UserViewCard
            v-for="(user, index) in paginatedUsers.data"
            :key="`user-${index}`"
            :user="user"
          />
          <Pagination
            :data="paginatedUsers.meta"
            :isDisabled="isLoading"
            @pageChange="getResults"
          />
        </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  name: 'ProfileFollowingPage',
  data: () => ({
    paginatedUsers: null,
    isLoading: false
  }),
  async created() {
    await this.getResults()
  },
  methods: {
    getResults(page = 1) {
      const username = this.$route.params.username
      this.isLoading = true
      axios.get(`/api/profile/following/${username}?page=${page}`)
          .then(({ data }) => this.paginatedUsers = data)
          .finally(() => this.isLoading = false);
    }
  }
}
</script>

<style lang="scss" scoped>
.profile-picture-container {
  background-color: #f1f2f3;
  border-radius: 5px;
}
</style>
